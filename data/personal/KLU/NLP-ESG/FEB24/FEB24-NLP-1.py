# Bag of words-> Bir corpustaki bir döküman neyle ilgili ilgili oldugu alan hangisi ? Hangi sözcükler önem taşıyor bunları görmemizi sağlayan yöntem
# Bag of words ve TF-IDF yöntemlerinden cıkarılan modeller makine ögrenmesi algoritmalarından kullanılabiliyor.
# Elimizde data varsa dataya işleyebilmek için ön işlemeye gerek var.
# Küçük harfe dönüştür
# Tokenization işlemi , tokenları belirle. Nltk kullanılabilir, spyce gibi. Bir cümle içinde kelimelerin önemi. 
# Kelimelerin geçiş sıklıklarına bakıcaz sonra. Corpusda kaç defa geçmiş kelimeler => histogram (HashMap)
# Document matrix =>  object(documents) , attributes(words)
# Histogramın belli bir sırasını ( 1000 kelime histogram ilk 100'ünü al , 1 tane geçenleri alma)
# Happy graph
# Stop wordleri atmak, stemming yapmak
# function o diline ait anahtar kelimeler - sözlüklerde yok
# substantine => o cümlenin anlamı belirleyen sıfat,isim - sözlükleri oluşturan şeyler sıfat fiil zarf, belirli bir sınırı yok
# Clustering -> bag of words. Summerization verdigimiz bir metnin önemli kısımlarının cıkarılması. Bag of words matrixi sıralarsan ilk cümle metin özetidir diyebilirsin


import nltk  
import numpy as np  
import random  
import string

import urllib.request  
import re  
import heapq


article_text = """
Check out his full speech below:
Thank you all so very much. 
Thank you to the Academy. 
Thank you to all of you in this room. 
I have to congratulate the other incredible nominees this year. 
The Revenant was the product of the tireless efforts of an unbelievable cast and crew. 
First off, to my brother in this endeavor, Mr. Tom Hardy. 
Tom, your talent on screen can only be surpassed by your friendship off screen … thank you for creating a transcendent cinematic experience. 
Thank you to everybody at Fox and New Regency … my entire team. 
I have to thank everyone from the very onset of my career … 
To my parents; none of this would be possible without you. 
And to my friends, I love you dearly; you know who you are.
And lastly, I just want to say this: Making The Revenant was about man's relationship to the natural world. 
A world that we collectively felt in 2015 as the hottest year in recorded history. 
Our production needed to move to the southern tip of this planet just to be able to find snow. 
Climate change is real, it is happening right now. 
It is the most urgent threat facing our entire species, and we need to work collectively together and stop procrastinating.
We need to support leaders around the world who do not speak for the big polluters, but who speak for all of humanity, for the indigenous people of the world, for the billions and billions of underprivileged people out there who would be most affected by this. 
For our children’s children, and for those people out there whose voices have been drowned out by the politics of greed. 
I thank you all for this amazing award tonight. 
Let us not take this planet for granted. 
I do not take tonight for granted. 
Thank you so very much.
"""

corpus = nltk.sent_tokenize(article_text)
for i in range(len(corpus )):
    corpus [i] = corpus [i].lower()
    corpus [i] = re.sub(r'\W',' ',corpus [i])
    corpus [i] = re.sub(r'\s+',' ',corpus [i])
    print(corpus[i])


wordfreq = {}
for sentence in corpus:
    tokens = nltk.word_tokenize(sentence)
    for token in tokens:
        if token not in wordfreq.keys():
            wordfreq[token] = 1
        else:
            wordfreq[token] += 1


most_freq = heapq.nlargest(100, wordfreq, key=wordfreq.get)


sentence_vectors = []

for sentence in corpus:
    sentence_tokens = nltk.word_tokenize(sentence)
    sent_vec = []
    for token in most_freq:
        if token in sentence_tokens:
            sent_vec.append(1)
        else:
            sent_vec.append(0)
    sentence_vectors.append(sent_vec)

print(sentence_vectors)
