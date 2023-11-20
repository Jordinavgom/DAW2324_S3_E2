from fastapi import FastAPI, Depends, HTTPException, status
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

app = FastAPI()

load_dotenv()
### Picanova ###
SECRET_KEY = os.getenv("SECRET_KEY")
ALGORITHM = os.getenv("ALGORITHM")

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