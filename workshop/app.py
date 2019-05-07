from flask import Flask, send_from_directory, request
from flask_wtf import Form
from wtforms import StringField, SubmitField
from wtforms.validators import Required


class TextToSpeech(Form):
    name = StringField('Enter the Text to translate', validators=[Required()])
    submit = SubmitField('Submit')

app = Flask(__name__, static_url_path='')
app.config['SECRET_KEY'] = 'hard to guess string'

@app.route('/data/<path:path>')
def send_js(path):
    return send_from_directory('data', path)

@app.route('/', methods=['GET', 'POST'])
def hello():
    if len(request.form.get('tospeech', ''))>0 and len(request.form.get('lang', ''))>0:
        from gtts import gTTS
        tts = gTTS(text=request.form['tospeech'], lang=request.form['lang'])
        tts.save("./data/good.mp3")
        return '''
<!DOCTYPE html>
<html>
<body>
    <audio controls>
    <source src="http://127.0.0.1:5000/data/good.mp3" type="audio/mpeg">
    Your browser does not support the audio element.
    </audio>
</body>
</html>'''
    return '''
<!DOCTYPE html>
<html>
<body>
    <form method="POST", action="/">
        Text: <input type="text" name="tospeech" value=""><br>
        <input type="radio" name="lang" value="fr"> Français <br>
        <input type="radio" name="lang" value="en"> English <br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>'''