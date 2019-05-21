from .celery import app


@app.task
def addition(x, y):
    return x + y


@app.task
def multiplication(x, y):
    return x * y


@app.task
def somme(*numbers):
    return sum(numbers)

@app.task
def hello(*names):
    return "Hello "+" ".join(names)