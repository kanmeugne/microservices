from gtts import gTTS
import os
tts = gTTS(text='Bienvenu à notre Atelier', lang='fr')
tts.save("./data/good.mp3")
#os.system("mpg321 good.mp3")