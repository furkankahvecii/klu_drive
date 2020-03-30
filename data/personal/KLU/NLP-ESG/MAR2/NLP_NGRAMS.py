'''
https://stackabuse.com/python-for-nlp-developing-an-automatic-text-filler-using-n-grams/
Verilen bir dizilimdeki (sequence) tekrar oranını bulmaya yarayan yöntemdir.
Bu model dili bilmeden bilgisayarın dili biliyormuş gibi davranmasına sebep oluyor. 
Recognition and generation
'''

import nltk
import numpy as np
import random
import string
import re

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
# window_size

# Karakter Bazlı N-gram (Characters N-Grams Model)

article_text = re.sub(r'[^A-Za-z. ]', '', article_text)

ngrams = {}
chars = 4

for i in range(len(article_text)-chars):
    seq = article_text[i:i+chars]
    print(seq)
    if seq not in ngrams.keys():
        ngrams[seq] = []
    ngrams[seq].append(article_text[i+chars])


curr_sequence = article_text[0:chars]
output = curr_sequence
for i in range(200):
    if curr_sequence not in ngrams.keys():
        break
    possible_chars = ngrams[curr_sequence]
    next_char = possible_chars[random.randrange(len(possible_chars))]
    output += next_char
    curr_sequence = output[len(output)-chars:len(output)]

print(output)


#Kelime bazlı N-Gram (Words N-Grams Model)

ngrams = {}
words = 3

words_tokens = nltk.word_tokenize(article_text)
for i in range(len(words_tokens)-words):
    seq = ' '.join(words_tokens[i:i+words])
    print(seq)
    if  seq not in ngrams.keys():
        ngrams[seq] = []
    ngrams[seq].append(words_tokens[i+words])

curr_sequence = ' '.join(words_tokens[0:words])
output = curr_sequence
for i in range(50):
    if curr_sequence not in ngrams.keys():
        break
    possible_words = ngrams[curr_sequence]
    next_word = possible_words[random.randrange(len(possible_words))]
    output += ' ' + next_word
    seq_words = nltk.word_tokenize(output)
    curr_sequence = ' '.join(seq_words[len(seq_words)-words:len(seq_words)])

print(output)