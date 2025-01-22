from django.db import models
from django.contrib.auth.models import User

class Todoo(models.Model):
    srno = models.AutoField(primary_key=True, auto_created=True)
    title = models.CharField(max_length=50)
    date = models.DateTimeField(auto_now_add=True)
    user = models.ForeignKey(User, on_delete=models.CASCADE)

    def __str__(self) -> str:
        return self.title
    
    class Meta:
        ordering = ['srno', 'title', 'date', 'user']
        verbose_name = "Todo"
        verbose_name_plural = "Todos"
