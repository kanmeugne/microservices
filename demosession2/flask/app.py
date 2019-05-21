from flask import Flask
from flask import render_template
from datetime import time
import pandas as pd
import os
from sqlalchemy import create_engine


app = Flask(__name__)
user = os.environ['MYSQL_USER']
passwd = os.environ['MYSQL_PASSWORD']
host = os.environ['MYSQL_HOST']
dbname = os.environ['MYSQL_DATABASE']
uri = 'mysql://{user}:{passwd}@{host}/{dbname}'.format(
    host=host,
    passwd=passwd,
    dbname=dbname,
    user=user
)
con = create_engine(uri)

@app.route("/simple_chart")
def chart():
    legend = 'Most used paiement methods (extract from DB)'
    df = pd.read_sql(
        "select * from {dbname}.answers".format(dbname=dbname),
        con
    )
    activities = [c for c in df.columns if c!='email']   
    values = [x for a in activities for x in df[a].values]
    d = {}
    for l in values:
        if l in d:
            d[l] += 1
        else:
            d[l] = 1
    return render_template('chart.html', values=[d[k] for k in d.keys()], labels=d.keys(), legend=legend)


@app.route("/line_chart")
def line_chart():
    legend = 'Temperatures'
    temperatures = [73.7, 73.4, 73.8, 72.8, 68.7, 65.2,
                    61.8, 58.7, 58.2, 58.3, 60.5, 65.7,
                    70.2, 71.4, 71.2, 70.9, 71.3, 71.1]
    times = ['12:00PM', '12:10PM', '12:20PM', '12:30PM', '12:40PM', '12:50PM',
             '1:00PM', '1:10PM', '1:20PM', '1:30PM', '1:40PM', '1:50PM',
             '2:00PM', '2:10PM', '2:20PM', '2:30PM', '2:40PM', '2:50PM']
    return render_template('line_chart.html', values=temperatures, labels=times, legend=legend)


@app.route("/time_chart")
def time_chart():
    legend = 'Temperatures'
    temperatures = [73.7, 73.4, 73.8, 72.8, 68.7, 65.2,
                    61.8, 58.7, 58.2, 58.3, 60.5, 65.7,
                    70.2, 71.4, 71.2, 70.9, 71.3, 71.1]
    times = [time(hour=11, minute=14, second=15),
             time(hour=11, minute=14, second=30),
             time(hour=11, minute=14, second=45),
             time(hour=11, minute=15, second=00),
             time(hour=11, minute=15, second=15),
             time(hour=11, minute=15, second=30),
             time(hour=11, minute=15, second=45),
             time(hour=11, minute=16, second=00),
             time(hour=11, minute=16, second=15),
             time(hour=11, minute=16, second=30),
             time(hour=11, minute=16, second=45),
             time(hour=11, minute=17, second=00),
             time(hour=11, minute=17, second=15),
             time(hour=11, minute=17, second=30),
             time(hour=11, minute=17, second=45),
             time(hour=11, minute=18, second=00),
             time(hour=11, minute=18, second=15),
             time(hour=11, minute=18, second=30)]
    return render_template('time_chart.html', values=temperatures, labels=times, legend=legend)


if __name__ == "__main__":
    app.run(
        debug=True,
        host='0.0.0.0',
        port=5000
    )
