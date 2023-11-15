from fastapi import FastAPI, HTTPException
from pydantic import BaseModel
from typing import Optional 
from fastapi.encoders import jsonable_encoder
import base64
import requests
import httpx

app = FastAPI()

### Picanova ###

# Defineix les credencials i les codifica en base64
credentials = 'ai-art-prints-apparel:ab6e8e9e8c2d46a7d8b47913f87d45c5'
encoded_credentials = base64.b64encode(credentials.encode()).decode()

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
async def create_order(order_data: CreateOrderRequest):
    auth_header = f'Basic {encoded_credentials}'
    
    # URL a la que s'envia la solicitud POST
    url = 'https://api.picanova.com/api/beta/orders'
 
    # Realitza la solicitud POST
    response = requests.post(url, json=jsonable_encoder(order_data), headers={'Authorization': auth_header})

    if response.status_code == 200:
        return response.json()
    else:
        raise HTTPException(status_code=400, detail=f"Error en la solicitud POST: {response.text}")

### BigJPG ###

class BigJpgRequest(BaseModel):
    style: str
    noise: str
    x2: str
    file_name: str
    input: str

@app.post("/api/task/")
def create_bigjpg_task(request: BigJpgRequest):
    # Enviar la solicitud en format JSON
    response = httpx.post(
        "https://bigjpg.com/api/task/",
        headers={'X-API-KEY': 'be6b547996ca47ac9d0bbf4bfdd5bade', 'Content-Type': 'application/json'},
        json=jsonable_encoder(request)  # Enviar les dades com JSON
    )

    if response.status_code == 200:
        return response.json()
    else:
        raise HTTPException(status_code=response.status_code, detail="Error en la solicitud a BigJPG")
