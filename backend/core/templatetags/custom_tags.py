from django import template
from django.apps import apps
from django.contrib.auth import get_user_model
import logging

register = template.Library()

@register.simple_tag
def get_model_count(app_label, model_name):
    if app_label == 'auth' and model_name == 'User':
        Model = get_user_model()
    else:
        Model = apps.get_model(app_label, model_name)
    return Model.objects.count() if Model else 0
