from django.db import models


class CustomerInformation(models.Model):
    first_name = models.CharField(max_length=50, null=True)
    last_name = models.CharField(max_length=80, null=True)
    email_address = models.EmailField()
    phone_number = models.CharField(max_length=20, null=True)
    address = models.CharField(max_length=255, null=True)
    additional_information = models.TextField(blank=True, null=True)

    class Meta:
        verbose_name_plural = "Customers Information"

    def __str__(self):
        return f"{self.first_name} {self.last_name}"
