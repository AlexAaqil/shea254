from django.urls import path
from . import views


app_name = 'order'


urlpatterns = [
    path('cart/', views.cart, name='cart'),
    path('cart/add/', views.add_to_cart, name='add_to_cart'),
    path('cart/update/quantity/', views.update_cart_quantity, name='update_cart_quantity'),
    path('cart/delete/', views.delete_from_cart, name='delete_from_cart'),

    path('checkout/', views.checkout, name='checkout'),
    path('checkout/success/<str:order_id>', views.order_confirmation, name='order_confirmation'),
]