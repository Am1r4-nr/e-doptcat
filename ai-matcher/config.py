import os
from dotenv import load_dotenv

load_dotenv()

class Config:
    """Base configuration"""
    DEBUG = False
    FLASK_ENV = 'production'
    API_PORT = int(os.getenv('AI_API_PORT', 5000))
    LARAVEL_DB_HOST = os.getenv('DB_HOST', 'localhost')
    LARAVEL_DB_USER = os.getenv('DB_USERNAME', 'root')
    LARAVEL_DB_PASSWORD = os.getenv('DB_PASSWORD', '')
    LARAVEL_DB_NAME = os.getenv('DB_DATABASE', 'laravel_app')
    MODEL_PATH = os.path.join(os.path.dirname(__file__), 'models', 'matcher_model.pkl')
    DATA_PATH = os.path.join(os.path.dirname(__file__), 'data', 'training_data.csv')

class DevelopmentConfig(Config):
    """Development configuration"""
    DEBUG = True
    FLASK_ENV = 'development'

# Select config based on environment
env = os.getenv('FLASK_ENV', 'development')
config = DevelopmentConfig() if env == 'development' else Config()
