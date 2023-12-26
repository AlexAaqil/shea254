from django.urls import path
from . import views


app_name = 'core'


urlpatterns = [
    path('', views.index, name='index'),

    path('shop/', views.shop, name='shop'),
    path('search/', views.search, name='search'),

    path('about/', views.about, name='about'),
    path('contact/', views.contact, name='contact'),
]