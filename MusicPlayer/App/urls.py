from django.conf import settings
from django.conf.urls.static import static
from django.urls import path
from App.views import *


app_name = "App"
urlpatterns = [
    path("",index,name="index")
]
