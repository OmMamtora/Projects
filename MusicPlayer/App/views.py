from django.shortcuts import render
from App.models import Song
from django.core.paginator import Paginator


def index(request):
    paginator = Paginator(Song.objects.all(), 1)
    page_number = request.GET.get('page')
    page_object = paginator.get_page(page_number)
    context = {'page_object':page_object}
    return render(request, "index.html",context)