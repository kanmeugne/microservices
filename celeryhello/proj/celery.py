from celery import Celery
import os

# urls for tasks
BROKER_URL = os.environ.get('REDIS_URL', 'redis://localhost:6379/0')
BACKEND_URL = os.environ.get('REDIS_URL', 'redis://localhost:6379/0')

# building the app
app = Celery(
	'celeryhello',
	broker=BROKER_URL,
	backend=BACKEND_URL,
	include=['proj.tasks']
)

# Optional configuration, see the application user guide.
app.conf.update(
    result_expires=3600,
)

# Entry point
if __name__ == '__main__':
    app.start()


