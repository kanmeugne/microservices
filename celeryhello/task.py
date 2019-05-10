import celery
import os

app = celery.Celery('celeryhello')

app.config.update(BROKER_URL=os.environ['REDIS_URL'], CELERY_RESULT_BACKEND_URL=os.environ['REDIS_URL'])

app.task
def hello(name):
	return "hello " + name

