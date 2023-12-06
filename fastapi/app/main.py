from fastapi import FastAPI, Depends, HTTPException, status, Request
from fastapi.responses import HTMLResponse
from fastapi.templating import Jinja2Templates
from pydantic import BaseModel
from typing import Optional 
from fastapi.encoders import jsonable_encoder
import base64
import requests
import httpx
from jose import JWTError, jwt
from fastapi.security import OAuth2PasswordBearer 
from dotenv import load_dotenv
import os
from fastapi import Form
from sqlalchemy import create_engine, Column, Integer, String, MetaData, Table, ForeignKey, Float

load_dotenv()
SECRET_KEY = os.getenv("SECRET_KEY")
ALGORITHM = os.getenv("ALGORITHM")
DB_USER = os.getenv("DB_USER")
DB_PASSWORD = os.getenv("DB_PASSWORD")
DB_HOST = os.getenv("DB_HOST")
DB_PORT = os.getenv("DB_PORT")
DB_NAME = os.getenv("DB_NAME")

# if user is None or userpassword is None or host is None or port is None or database is None:
#     print(user)
#     raise ValueError("Please set all the required environment variables.")
    

database_user_uri = f"mariadb+pymysql://{DB_USER}:{DB_PASSWORD}@{DB_HOST}:{DB_PORT}/{DB_NAME}"
print ("user ======", {database_user_uri})

# from sqlalchemy.exc import OperationalError

# try:
    # engine = create_engine(database_user_uri)
#     connection = engine.connect()
#     print("Conexión exitosa a la base de datos.")
#     connection.close()
# except OperationalError as e:
#     print(f"Error al conectar a la base de datos: {e}")


####

app = FastAPI()

templates = Jinja2Templates(directory="templates")

@app.get("/ping/picanova")
async def ping_picanova():
    response = requests.get('https://api.picanova.com/')
    return {"status_code": response.status_code}

@app.get("/ping/bigJPG")
async def ping_big_jpg():
    response = requests.get('https://bigjpg.com/')
    return {"status_code": response.status_code}

@app.get("/api-status", response_class=HTMLResponse)
async def read_api_status(request: Request):
    ping_picanova_result = await ping_picanova()
    ping_big_jpg_result = await ping_big_jpg()
    
    return templates.TemplateResponse("home.html", {
        "request": request,
        "ping_picanova_result": ping_picanova_result,
        "ping_big_jpg_result": ping_big_jpg_result
    })


### Picanova ###

oauth2_scheme = OAuth2PasswordBearer(tokenUrl="token")

external_api_user = "alumne"
external_api_password = "2b8af5289aa93fc62eae989b4dcc9725"

# Defineix les credencials i les codifica en base64
credentials = 'ai-art-prints-apparel:ab6e8e9e8c2d46a7d8b47913f87d45c5'
encoded_credentials = base64.b64encode(credentials.encode()).decode()
print(f"SECRET_KEY: {SECRET_KEY}")
print(f"ALGORITHM: {ALGORITHM}")
def create_token(data: dict):
    return jwt.encode(data, SECRET_KEY, algorithm=ALGORITHM)

def get_current_user(token: str = Depends(oauth2_scheme)):
    credentials_exception = HTTPException(
        status_code=status.HTTP_401_UNAUTHORIZED,
        detail="Invalid credentials",
        headers={"WWW-Authenticate": "Bearer"},
    )
    try:
        # Decodificar el token y obtener la información del usuario
        payload = jwt.decode(token, SECRET_KEY, algorithms=[ALGORITHM])
        return payload
    except JWTError:
        # Capturar errores relacionados con el token
        raise credentials_exception
    
def verify_credentials(username: str, password: str):
    return username == external_api_user and password == external_api_password

@app.post("/token")
def login(username: str = Form(...), password: str = Form(...)):
    credentials_exception = HTTPException(
        status_code=status.HTTP_401_UNAUTHORIZED,
        detail="Invalid credentials",
        headers={"WWW-Authenticate": "Bearer"},
    )
    try:
        # Verificar las credenciales proporcionadas
        if verify_credentials(username, password):
            # Credenciales válidas, generar un token
            data = {"sub": username}
            access_token = create_token(data)
            return {"access_token": access_token, "token_type": "bearer"} #retornar token en cas que estigue correcte
        else:
            # Credenciales inválidas, lanzar una excepción
            raise credentials_exception
    except Exception as e:
        # Capturar otros errores
        return {"message": f"Error : {str(e)}"}

class ShippingDetails(BaseModel):
    email: str
    firstname: str
    lastname: str
    company: Optional[str]
    street_primary: str
    street_secondary: Optional[str]
    city: str
    postcode: str
    country_id: int
    region_id: Optional[int]
    telephone: str

class Item(BaseModel):
    external_id: Optional[str]
    quantity: int
    variant_code: str
    customs_value: float
    file: str
    options: dict

class CreateOrderRequest(BaseModel):
    external_id: Optional[str]
    is_test: bool
    shipping_method: str
    customs_shipping_costs: float
    shipping: ShippingDetails
    items: list[Item]

@app.post("/orders")
def create_order(order_data: CreateOrderRequest, current_user: dict = Depends(get_current_user)):
    try:
        # URL a la que se enviará la solicitud POST para crear una orden
        url = 'https://api.picanova.com/api/beta/orders'
     
        # Realiza la solicitud POST a la API externa de Picanova
        response = requests.post(url, json=jsonable_encoder(order_data), headers={'Authorization': f'Basic {encoded_credentials}'})

        # Verifica el código de estado de la respuesta
        if response.status_code == 200:
            return response.json()
        else:
            # Si la respuesta no es exitosa, lanza una excepción HTTP con el detalle del error
            raise HTTPException(status_code=400, detail=f"Error en la solicitud POST a Picanova: {response.text}")
    
    except Exception as e:
        # Captura otros errores y los devuelve como detalle en la excepción HTTP
        raise HTTPException(status_code=500, detail=f"Error interno en el servidor: {str(e)}")
    

### CREACIO TAULES ###

# Crear la instancia de motor de SQLAlchemy
engine = create_engine(database_user_uri)

# Definir metadata y la tabla
metadata = MetaData()

# Crea la tabla si no existe
# metadata.create_all(engine)

### TAULA PRODUCTES ###
products_table = Table(
    'products', metadata,
    Column('idProduct', Integer),
    Column('name', String(255)),  # Ajusta el tipo y nombre de las columnas según tus necesidades
    Column('variants', Integer),
    Column('sku', String(255)),
    Column('dpi', Integer),
    Column('type', String(255)),
    # Agrega más columnas según sea necesario
)

### TAULA IMATGES PRODUCTES ###
products_images_table = Table(
    'productImages', metadata,
    Column('idProductImage', Integer),
    Column('original', String(255)),
    Column('thumb', String(255)),
    Column('idProduct', Integer),
    # Agrega más columnas según sea necesario
)

# Tabla de detalles de productos
product_details_table = Table(
    'productDetails', metadata,
    Column('idProductDetail', Integer),
    Column('idProduct', Integer),  # Clave foránea que apunta al ID del producto
    Column('code', String(255)),
    Column('idVariant', Integer),
    Column('variant_code', String(255)),
    Column('sku', String(255)),
    Column('name', String(255)),
    Column('format_width', Integer),
    Column('format_height', Integer),
    Column('price', Float),
    Column('currency', String(3)),
    Column('formatted_price', String(20)),
    Column('price_in_subunit', Integer),
    # Agrega más columnas según sea necesario
)

# Crea la tabla de imágenes si no existe
# metadata.create_all(engine)


@app.get("/products")
async def get_and_insert_products(current_user: dict = Depends(get_current_user)):
    try:
        # URL del nuevo endpoint
        url = 'https://api.picanova.com/api/beta/products'

        async with httpx.AsyncClient() as client:
            # Realiza la solicitud GET al nuevo endpoint
            response = await client.get(
                url,
                headers={'Authorization': f'Basic {encoded_credentials}'}  # Ajusta según tus necesidades
            )

            # Verifica el código de estado de la respuesta
            if response.status_code == 200:
                # Obtiene la lista de productos desde la respuesta JSON
                response_data = response.json()

                # Asegúrate de que la respuesta tenga una estructura de diccionario
                if isinstance(response_data, dict):
                    # Accede a la lista de productos dentro de la clave 'data'
                    products_data = response_data.get('data', [])

                    with engine.connect() as connection:
                        # Itera sobre la lista de productos y realiza la inserción en la base de datos
                        for product_data in products_data:
                            product_id = product_data.get('id')
                            name = product_data.get('name')
                            variants = product_data.get('variants')
                            sku = product_data.get('sku')
                            dpi = product_data.get('dpi')
                            product_type = product_data.get('type')

                            # Verifica si 'id' está presente antes de intentar insertarlo
                            if product_id is not None:
                                # Realiza la inserción del producto en la base de datos
                                ins_product = products_table.insert().values(
                                    idProduct=product_id,
                                    name=name,
                                    variants=variants,
                                    sku=sku,
                                    dpi=dpi,
                                    type=product_type
                                )

                                # Ejecuta la sentencia de inserción del producto
                                result = connection.execute(ins_product)
                                product_id = result.lastrowid  # Obtiene el ID del producto insertado

                                # Itera sobre la lista de imágenes y realiza la inserción en la base de datos
                                images_data = product_data.get('images', [])
                                for image_data in images_data:
                                    image_id = image_data.get('id')
                                    original = image_data.get('original')
                                    thumb = image_data.get('thumb')

                                    # Realiza la inserción de la imagen en la base de datos
                                    ins_image = products_images_table.insert().values(
                                        idProductImage=image_id,
                                        original=original,
                                        thumb=thumb,
                                        idProduct=product_id
                                    )

                                    # Ejecuta la sentencia de inserción de la imagen
                                    connection.execute(ins_image)

                                product_details_data = await get_product_details_from_api(product_id, encoded_credentials)

                                for product_detail_data in product_details_data:
                                    id = product_detail_data.get('id')
                                    code = product_detail_data.get('code')
                                    variant_id = product_detail_data.get('variant_id')
                                    variant_code = product_detail_data.get('variant_code')
                                    sku=product_detail_data.get('sku')
                                    name=product_detail_data.get('name')
                                    format_width=product_detail_data.get('printfile', {}).get('format_width')
                                    format_height=product_detail_data.get('printfile', {}).get('format_height')
                                    price=product_detail_data.get('price')
                                    currency=product_detail_data.get('price_details', {}).get('currency')
                                    formatted_price=product_detail_data.get('price_details', {}).get('formatted')
                                    price_in_subunit=product_detail_data.get('price_details', {}).get('in_subunit')
                                    print(f'La ID del {product_id} es: {id} ...... correspon a {code}???¿¿¿')

                                    ins_details = product_details_table.insert().values(
                                        idProductDetail=id,
                                        idProduct=product_id,
                                        code=code,
                                        variant_id=variant_id,
                                        variant_code=variant_code,
                                        sku=sku,
                                        name=name,
                                        format_width=format_width,
                                        format_height=format_height,
                                        price=price,
                                        currency=currency,
                                        formatted_price=formatted_price,
                                        price_in_subunit=price_in_subunit
                                    )

                                    connection.execute(ins_details)
                                        


                    return {"message": "IDs de productos insertados en la base de datos"}

                else:
                    # Si la respuesta no es un diccionario, lanza una excepción
                    raise HTTPException(status_code=500, detail="La respuesta de la API no es válida")

            else:
                # Si la respuesta no es exitosa, lanza una excepción HTTP con el detalle del error
                raise HTTPException(status_code=400, detail=f"Error en la solicitud GET: {response.text}")

    except Exception as e:
        # Captura y registra el error
        print(f"Error: {str(e)}")

        # Lanza una excepción HTTP con un mensaje genérico
        raise HTTPException(status_code=500, detail="Error interno del servidor")


async def get_product_details_from_api(product_id: int, encoded_credentials: str) -> dict:
    url = f'https://api.picanova.com/api/beta/products/{product_id}'
    async with httpx.AsyncClient() as client:
        response = await client.get(
            url,
            headers={'Authorization': f'Basic {encoded_credentials}'}
        )
        if response.status_code == 200:
            return response.json().get('data', {})
        return {}

### BigJPG ###

class BigJpgRequest(BaseModel):
    style: str
    noise: str
    x2: str
    file_name: str
    input: str

@app.post("/api/task/")
def create_bigjpg_task(request: BigJpgRequest, current_user: dict = Depends(get_current_user)):
    try:
        # Enviar la solicitud a BigJPG en formato JSON
        response = httpx.post(
            "https://bigjpg.com/api/task/",
            headers={'X-API-KEY': 'be6b547996ca47ac9d0bbf4bfdd5bade', 'Content-Type': 'application/json'},
            json=jsonable_encoder(request)
        )

        # Verificar el código de estado de la respuesta
        if response.status_code == 200:
            return response.json()
        else:
            # Si la respuesta no es exitosa, lanza una excepción HTTP con el detalle del error
            raise HTTPException(status_code=response.status_code, detail="Error en la solicitud a BigJPG")

    except Exception as e:
        # Captura otros errores y los devuelve como detalle en la excepción HTTP
        raise HTTPException(status_code=500, detail=f"Error interno en el servidor: {str(e)}")