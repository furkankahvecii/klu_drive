# https://stackabuse.com/text-classification-with-python-and-scikit-learn/

'''


1. Dataseti import et
2. Text Preprocessing(Önişleme)
3. Bag of word(BOW) modeli çıkar
4. Bu modeli Tfidf modeline donustur
5. Train ve test verileri oluştur
6. Makine ögrenmesi algoritması(Logistic Regression) ile train verileri eğit
7. Eğitilen modele test datasını yollayıp prediction gerçekleştir
8. Confusion matrisi ile kontrol et
9. Bu modeli kaydet

'''
import numpy
import re
import pickle
import nltk
from nltk.corpus import stopwords
from sklearn.datasets import load_files

'''
Pickle 
    O an hali hazırda bulunan listeleri,yapıları bellekte bulunduğu haliyle diske aktarmak için kullanılan python kütüphanesi.
    Kaydedilen pickle dosyaları istenilen gibi load edilip kullanılır.

'''

# reviews = load_files("txt_sentoken/")
# x = reviews.data -> Her bir dosyadan almış oldugu text(byte şeklinde okumuş oldugu text)
# y = reviews.target -> Okumuş oldugu her bir dosyayı neresinden okudu ? (0->negatif,1->pozitif) Classları.

# with open('x.pickle','wb') as f:
#     pickle.dump(x,f)
# with open('y.pickle','wb') as f:
#     pickle.dump(y,f)

x_in = open('x.pickle','rb') # Dosyayı oku 
y_in = open('y.pickle','rb')

x = pickle.load(x_in) # Dosyanın içeriğini al
y = pickle.load(y_in)

# x'in içerisinde çekmiş olduğumuz textleri işlemek gerekiyor.
corpus = [] 

for i in range(0, len(x)):
    # Remove all the special characters
    review = re.sub(r'\W', ' ', str(x[i])) 
    # Remove all single characters
    review = re.sub(r'\s\w\s', ' ', review) 
    # Remove single characters from the start
    review = re.sub(r'^\w\s', ' ', review) 
    # Substituting multiple spaces with single space
    review = re.sub(r'\s+', '', review)
    
    review = review.strip()
    corpus.append(review)

# Corpus içinde bag of words işlemini gerçekleştiriyor.
# max_feautures maksimum 2000 kelime
# min_df => minimum 2 defa geçsin
# max_df => geçme sıklığı yüzde 70'inde daha fazla geçmiş olmasın

from sklearn.feature_extraction.text import CountVectorizer
vectorizer = CountVectorizer(max_features=2000, min_df=2, max_df=0.7, stop_words=stopwords.words('english'))
X = vectorizer.fit_transform(corpus).toarray() # Bag of word dizisi

# TfidfTransformer => Bag of Words dizisini tfidf'e dönüştürülmesini sağlar

from sklearn.feature_extraction.text import TfidfTransformer
tfidfconverter = TfidfTransformer()
X = tfidfconverter.fit_transform(X).toarray()

# Makine ögrenmesi modelinde datanın bir kısmı test diger kısmı da train için kullanılır.
# test_size => veri oranı (%20 test, %80 train)
# random_state => rastgele veri seçme

from sklearn.model_selection import train_test_split
text_train, text_test, class_train, class_test = train_test_split(X, y, test_size = 0.2, random_state=0)

# LogisticRegression ile öğrenme
# Logistic Regression => İkili bir sınıflandırma problemini çözmeye yarayan bir sınıflandırıcıdır.
from sklearn.linear_model import LogisticRegression
classifier = LogisticRegression()
classifier.fit(text_train, class_train) # Eğitme işlemi

pred = classifier.predict(text_test) # Test datasını verip , prediction gerçekleştirmeye calısıcak.

# dogruluk matrisi (confusion_matrix)
# Ne kadar dogru ne kadar yanlis gormek icin.
from sklearn.metrics import confusion_matrix
cm = confusion_matrix(class_test, pred)

with open('model.pickle','wb') as f:
    pickle.dump(classifier, f)

text = ["love this film the plot is amazing"]
'''
from sklearn.feature_extraction.text import TfidfVectorizer
tfidfVectorizer = TfidfVectorizer(max_features=2000, stop_words=stopwords.words('english'))
X = tfidfVectorizer.fit_transform(text).toarray()

p = classifier.predict(X)
print(p)
'''