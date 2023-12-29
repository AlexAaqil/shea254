from django.contrib import admin
from django.utils.html import format_html
from .models import Category, Product, ProductImages, Order

class CategoryAdmin(admin.ModelAdmin):
    list_display = ['title', 'slug', 'category_image']


class ProductImagesAdmin(admin.TabularInline):
    model = ProductImages
    max_num = 3


class ProductAdmin(admin.ModelAdmin):
    inlines = [ProductImagesAdmin]
    list_editable = ['featured', 'in_stock']
    list_display = ['pid', 'product_image', 'title', 'category', 'price', 'featured', 'in_stock']


class OrderAdmin(admin.ModelAdmin):
    readonly_fields = ('oid', 'first_name', 'last_name', 'email_address', 'phone_number', 'address', 'formatted_items', 'total_amount',  'additional_information', 'created_at')

    list_editable = ['order_status', 'payment_status']

    list_display = ['oid', 'first_name', 'last_name', 'email_address', 'order_status', 'payment_status']

    exclude = ('items',)

    def formatted_items(self, obj):
        items_string = []

        for product_id, item in obj.items.items():
            items_string.append(
                f"<li><img src='{item['image']}' width='40' height='40'> {item['title']} ( {item['quantity']} x {item['price']} )</li>"
                )

        return format_html('<br>'.join(items_string))

    formatted_items.short_description = 'Items'


admin.site.register(Category, CategoryAdmin)
admin.site.register(Product, ProductAdmin)
admin.site.register(Order, OrderAdmin)
