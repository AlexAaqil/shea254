import os
from django.db import models
from django.utils.html import mark_safe
from django.core.exceptions import ValidationError
from django.utils.text import slugify
from django.utils import timezone

from decimal import Decimal
from shortuuid.django_fields import ShortUUIDField
from ckeditor_uploader.fields import RichTextUploadingField


STATUS = (
    ("disabled", "Disabled"),
    ("published", "Published"),
)


class ProductSize(models.Model):
    title = models.CharField(unique=True, max_length=15)

    def __str__(self):
        return self.title


class CategoryAndProduct(models.Model):
    slug = models.SlugField(unique=True, blank=True)

    def save(self, *args, **kwargs):
        if not self.slug or self.title != self._meta.model.objects.get(pk=self.pk).title:
            self.slug = slugify(self.title)

        super().save(*args, **kwargs)

    class Meta:
        abstract = True


class Category(CategoryAndProduct):
    cid = ShortUUIDField(unique=True, length=10, max_length=20, prefix="cat", alphabet="abcdefg12345")
    title = models.CharField(max_length=255, unique=True)
    category_order = models.IntegerField(default=0)

    def get_absolute_url(self):
        return f"/category/{self.slug}/"

    class Meta:
        verbose_name_plural = "Categories"

    def __str__(self):
        return self.title


class Product(CategoryAndProduct):
    pid = ShortUUIDField(unique=True, length=10, max_length=20, alphabet="abcdefg12345")
    category = models.ForeignKey(Category, on_delete=models.SET_NULL, null=True)
    title = models.CharField(unique=True, max_length=100, default="Product Title")
    description = RichTextUploadingField(null=True, blank=True, default="Product Description")
    size = models.ForeignKey(ProductSize, on_delete=models.SET_NULL, null=True, blank=True)
    price = models.DecimalField(max_digits=999999999999, decimal_places=2, default=Decimal('0.00'))
    discount_price = models.DecimalField(max_digits=999999999999, decimal_places=2, default=Decimal('0.00'))

    product_status = models.CharField(choices=STATUS, max_length=10, default="published")
    in_stock = models.BooleanField(default=True)
    featured = models.BooleanField(default=False)

    image = models.ImageField(upload_to="uploads/product_images", blank=True, null=True)

    created_at = models.DateTimeField(auto_now_add=True)
    updated_at = models.DateTimeField(null=True, blank=True)

    def save(self, *args, **kwargs):
        if self.image:
            # Get the original file extension
            original_extension = os.path.splitext(self.image.name)[1]

            # Update the image filename with the original file extension
            image = f"product_{self.id}_{timezone.now().strftime('%m%d%Y')}{original_extension}"
            self.image.name = image

        super().save(*args, **kwargs)

    def delete(self, *args, **kwargs):
        # Call the original delete() method first
        super().delete(*args, **kwargs)

        # Delete the associated image file from the storage
        if self.image:
            self.image.storage.delete(self.image.name)

    def get_image_prefix(self):
        return "product"

    def get_absolute_url(self):
        return f"/product/{self.slug}/"

    def get_image_url(self):
        try:
            url = self.image.url
        except:
            url = '/static/images/default_product.jpg'
        return url

    def admin_panel_image(self):
        if self.image:
            return mark_safe('<img src="%s" width=50 height=50>' % (self.image.url))
        return mark_safe('<img src="%s" width=50 height=50>' % '/static/images/default_product.jpg')

    class Meta:
        verbose_name_plural = "Products"

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
