# TF-IDF bazı sözcüklere daha çok önem atama.
# Term frequency => Cümledeki kelime sayısı / Cümledeki toplam kelimesi
# Sözcüklerin birbiri ardına gelmesi söz konusu -> n gram
# Öbek bazlı. Markov Chains => olasılık, bir şeyin bir başka şeyin ardına gelme olasılığı, çevirme yapılmasında
# Sözcük bazlı inceledik , n gram öbek bazlı inceliyoz en az 2 alıyoruz, anlamlı ifadeleri bulmaya calısıyoruz, tesadüfün ötesinde bi duruma izin vermiyoruz
# n gramları cıkarırken de mantık bu.

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


wordfreq = {}
for sentence in corpus:
    tokens = nltk.word_tokenize(sentence)
    for token in tokens:
        if token not in wordfreq.keys():
            wordfreq[token] = 1
        else:
            wordfreq[token] += 1

most_freq = heapq.nlargest(100, wordfreq, key=wordfreq.get)


word_idf_values = {}

for token in most_freq:
    doc_containing_word = 0
    for document in corpus:
        if token in nltk.word_tokenize(document):
            doc_containing_word += 1
    word_idf_values[token] = np.log(len(corpus)/(1 + doc_containing_word))


word_tf_values = {}

for token in most_freq:
    sent_tf_vector = []
    for document in corpus:
        doc_freq = 0
        for word in nltk.word_tokenize(document):
            if token == word:
                  doc_freq += 1
        word_tf = doc_freq/len(nltk.word_tokenize(document))
        sent_tf_vector.append(word_tf)
    word_tf_values[token] = sent_tf_vector


tfidf_values = []
for token in word_tf_values.keys():
    tfidf_sentences = []
    for tf_sentence in word_tf_values[token]:
        tf_idf_score = tf_sentence * word_idf_values[token]
        tfidf_sentences.append(tf_idf_score)
    tfidf_values.append(tfidf_sentences)

tf_idf_model = np.transpose(tf_idf_model)
