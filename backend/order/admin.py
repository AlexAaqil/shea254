from django.contrib import admin
from django.utils.html import format_html

from .models import CartOrder, CartOrderItem


class CartOrderItemAdmin(admin.ModelAdmin):
    list_display = ['product', 'order', 'quantity']


class CartOrderItemInline(admin.TabularInline):
    model = CartOrderItem
    extra = 0  # Number of empty forms to displa


class CartOrderAdmin(admin.ModelAdmin):
    list_display = ['oid', 'customer', 'order_status', 'payment_status', 'created_at']
    list_editable = ['order_status', 'payment_status']
    readonly_fields = ['oid', 'customer', 'created_at', 'view_cart_order_items', 'get_cart_total_items', 'get_cart_total_amount']
    inline = [CartOrderItemInline]

    def view_cart_order_items(self, obj):
        items = obj.order_items.all()
        print(items)
        items_string = [
            f"<li><img src='{item.product.image.url}' width='40' height='40'> {item.product.title} ( {item.quantity} x {item.product.price} )</li>"
            for item in items
        ]
        return format_html('<br>'.join(items_string))

    view_cart_order_items.short_description = 'Cart Order Items'


admin.site.register(CartOrder, CartOrderAdmin)
admin.site.register(CartOrderItem, CartOrderItemAdmin)
