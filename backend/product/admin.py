from django.contrib import admin
from .models import ProductSize, Product, ProductImages, Category


class CategoryAdmin(admin.ModelAdmin):
    list_display = ['title', 'slug']
    readonly_fields = ['cid', 'slug']


class ProductSizeAdmin(admin.ModelAdmin):
    list_display = ['title']


class ProductImagesAdmin(admin.TabularInline):
    model = ProductImages
    max_num = 3


class ProductAdmin(admin.ModelAdmin):
    inlines = [ProductImagesAdmin]
    list_editable = ['featured', 'in_stock']
    list_display = ['pid', 'admin_panel_image', 'title', 'slug', 'size', 'category', 'price', 'featured', 'in_stock']
    readonly_fields = ['pid', 'slug']


admin.site.register(Category, CategoryAdmin)
admin.site.register(ProductSize, ProductSizeAdmin)
admin.site.register(Product, ProductAdmin)
