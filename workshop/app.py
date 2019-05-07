from flask import Flask, send_from_directory, request
import os

root_path = ''
app = Flask(__name__, static_url_path=root_path)

def dir_last_updated(folder):
    return str(max(os.path.getmtime(os.path.join(root_path, f))
               for root_path, dirs, files in os.walk(folder)
               for f in files))

@app.route('/data/<path:path>')
def servefile(path):
    return send_from_directory('data', path, )

@app.route('/', methods=['GET', 'POST'])
def hello():
    if len(request.form.get('tospeech', ''))>0 and len(request.form.get('lang', ''))>0:
        from gtts import gTTS
        tts = gTTS(text=request.form['tospeech'], lang=request.form['lang'])
        tts.save(os.path.join(root_path, "data/translate.mp3"))
        return '''
<!DOCTYPE html>
<html>
<body>
    <p> Saying <b>{}</b> ({}) </p>
    <audio controls>
    <source src="http://127.0.0.1:5000/data/translate.mp3?{}" type="audio/mpeg">
    Your browser does not support the audio element.
    </audio>
</body>
</html>'''.format(request.form['tospeech'], request.form['lang'], dir_last_updated(os.path.join(root_path, 'data')))
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

if __name__ == "__main__":
    app.run(
        debug=True,
        host='0.0.0.0',
        port=5000
    )