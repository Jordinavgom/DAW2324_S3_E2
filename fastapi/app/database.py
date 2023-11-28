# import os
# from dotenv import load_dotenv
# from sqlalchemy import create_engine, Column, Integer, String, MetaData, Table

# load_dotenv()
# SECRET_KEY = os.getenv("SECRET_KEY")
# ALGORITHM = os.getenv("ALGORITHM")
# DB_USER = os.getenv("DB_USER")
# DB_PASSWORD = os.getenv("DB_PASSWORD")
# DB_HOST = os.getenv("DB_HOST")
# DB_PORT = os.getenv("DB_PORT")
# DB_NAME = os.getenv("DB_NAME")

# user = DB_USER
# userpassword = DB_PASSWORD
# host = DB_HOST
# port = DB_PORT
# database = DB_NAME

# # if user is None or userpassword is None or host is None or port is None or database is None:
# #     print(user)
# #     raise ValueError("Please set all the required environment variables.")
    

# database_user_uri = f"mariadb+pymysql://{user}:{userpassword}@{host}:{port}/{database}"
# print ("user ======", {database_user_uri})