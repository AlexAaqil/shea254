from django.db import models
from shortuuid.django_fields import ShortUUIDField
from ckeditor_uploader.fields import RichTextUploadingField
from django.utils.html import mark_safe
from django.core.exceptions import ValidationError


STATUS = (
    ("disabled", "Disabled"),
    ("published", "Published"),
)

ORDER_STATUS = (
    ("pending", "Pending"),
    ("processed", "Processed"),
)


class Category(models.Model):
    cid = ShortUUIDField(unique=True, length=10, max_length=20, prefix="cat", alphabet="abcdefg12345")
    title = models.CharField(max_length=255, unique=True)
    slug = models.SlugField(unique=True)
    image = models.ImageField(upload_to="uploads/categories", default="category.jpg")

    class Meta:
        verbose_name_plural = "Categories"

    def category_image(self):
        return mark_safe('<img src="%s" width=50 height=50>' % (self.image.url))

    def __str__(self):
        return self.title


class Product(models.Model):
    pid = ShortUUIDField(unique=True, length=10, max_length=20, alphabet="abcdefg12345")
    title = models.CharField(max_length=100, default="Product Title")
    category = models.ForeignKey(Category, on_delete=models.SET_NULL, null=True)
    description = RichTextUploadingField(null=True, blank=True, default="Product Description")
    price = models.DecimalField(max_digits=999999999999, decimal_places=2, default="0.00")
    new_price = models.DecimalField(max_digits=999999999999, decimal_places=2, default="0.00")
    product_status = models.CharField(choices=STATUS, max_length=10, default="published")
    image = models.ImageField(upload_to="uploads/product_images", default="product.jpg")
    in_stock = models.BooleanField(default=True)
    featured = models.BooleanField(default=False)

    created_at = models.DateTimeField(auto_now_add=True)
    updated_at = models.DateTimeField(null=True, blank=True)

    class Meta:
        verbose_name_plural = "Products"

    def product_image(self):
        return mark_safe('<img src="%s" width=50 height=50>' % (self.image.url))

    def __str__(self):
        return self.title


class ProductImages(models.Model):
    images = models.ImageField(upload_to="uploads/product_images", default="Product.jpg")

    product = models.ForeignKey(Product, on_delete=models.SET_NULL, null=True, related_name="product_images")
    created_at = models.DateTimeField(auto_now_add=True)

    def clean(self):
        if self.product.product_images.count() >= 3:
            raise ValidationError("Maximum of 3 images allowed per product.")

    def delete(self, *args, **kwargs):
        # Call the original delete() method first
        super().delete(*args, **kwargs)

        # Delete the associated image file from the storage
        self.images.storage.delete(self.images.name)

    class Meta:
        verbose_name_plural = "Product Images"


class Order(models.Model):
    oid = ShortUUIDField(unique=True, length=10, max_length=20, prefix="ord", alphabet="abcdefg12345")
    first_name = models.CharField(max_length=50)
    last_name = models.CharField(max_length=80)
    email_address = models.EmailField()
    phone_number = models.CharField(max_length=20)
    address = models.CharField(max_length=255)
    additional_information = models.TextField(blank=True)
    items = models.JSONField()
    total_amount = models.DecimalField(max_digits=10, decimal_places=2)
    order_status = models.CharField(choices=ORDER_STATUS, max_length=10, default="pending")
    payment_status = models.BooleanField(default=False)
    created_at = models.DateTimeField(auto_now_add=True)

    def __str__(self):
        return f"Order #{self.oid} - {self.first_name} {self.last_name}"
