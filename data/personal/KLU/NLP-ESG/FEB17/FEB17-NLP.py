
'''
 Sent_tokenize
    Cümlelerin ayrıştırılması işlemini gerçekleştiriyor. 
    Sentence tokenize işlemleri bizim gibi Latin alfabesi kullanan alfabelerde rahatlıkla uygulanabiliyor. 
    Başka diller(kelimeler arası boşluk kullanılmayan ,bitişik diller) de başka şeyler kullanılması gerekiyor.
'''

# from nltk.tokenize import sent_tokenize
# parag = "Bu bir deneme paragrafıdır. Bu paragrafta cümleler olacak. Bunları ayrıştırmamız gerekecek."
# splitted = sent_tokenize(parag)
# print(splitted)    
# sp2 = word_tokenize(splitted[0])
# sp2 = word_tokenize("I won't call this number again!")

'''
Word_tokenize
    Kelimelerin ayrıştırılması işlemini gerçekleştiriyor. 
    Ama bazı durumlarda ayrıştıramadığı durumlar oluyor. 
    Example = ' I won't call this number again! '
    Türkçe için sıkıntı çıkarmayabilir bu işlem.
    Word_tokenize işleminin çalışma mantığı, daha önce eğitilmiş olduğu bir corpus üzerinden ayrıştırma işlemini gerçekleştiriyor.
    Başka tokenize işlemini gerçekleştiren fonksiyonlar var

TreebankWordTokenizer
    Bunlar bir class, nesne oluşturularak kullanılırlar.
    Fonksiyonlar kücük harfler, sınıflar büyük harfle başlar ve camelcase yöntemi ile adlandırılırlar.
    İstedigimiz ayrıştırma işlemini gerçekleştirmiyor.

WordPunctTokenizer
    Başka bir model tarafından eğitilmiş bir tokenize
    İstedigimiz ayrıştırma işlemini gerçekleştirmiyor.
'''
# from nltk.tokenize import word_tokenize
# from nltk.tokenize import TreebankWordTokenizer
# from nltk.tokenize import WordPunctTokenizer

# treeBankInstance = TreebankWordTokenizer()
# wordPunctInstance = WordPunctTokenizer()

# s = "I won't call this number again!"

# sp2 = word_tokenize(s)
# sp3 = treeBankInstance.tokenize(s)
# sp4 = wordPunctInstance.tokenize(s)

# print(sp2)
# print(sp3)
# print(sp4)

'''
Nltk Tokenizerları
    Nltk'nın arkasındaki tokenizerları won't doğru ayrıştıramadı.
    Çünkü arka planda eğitilmiş bir makine öğrenmesi modeliyle çalışıyor. 
    Öğrendiği bilgilerde won't la pek karşılaşılmamış, resmi metinler üzerinden eğitilmiş.
    Bu yüzden nltk'nın tokenizerlerının ayrıştıramadığı şeyleri regex ile yapabiliyoruz.
Regexp_tokenize
    İçerisine vermiş olduğunuz metin + regular expresion ile içerisindeki ayrıştırılmış kelimeleri çıkarıyor.
    '!' noktalama işaretini bu metod bulamadı, çünkü işimiz yok. 
    Kelimelerin ayrıştırılması yeterli
    Derin ögrenme uygulamalarında anlamın çok fazla önemi yok, arka planda neural network kullanılıyor. 
    Neural network içerisine bizim verdiğimiz kelimelerden oluşturulmuş word vector giriyor.
    Bu metod basit anlamda yeterli olucaktır. Sıkıntı olursa regexi değiştir.
'''
# from nltk.tokenize import regexp_tokenize

# print(regexp_tokenize(s,"[\w']+"))

'''
Lematization
    Köke inme(stemming) işlemlerini gerçekleştiren stemmerlarımız var.
    PorterStemmer köke inerken hatalar yapabiliyor.
    Doğru kökü bulmak için lematization işlemini dediğimiz sözlük kullanmamız gerek.
    Sözlüğe bakıp kelime kökenine ordan gidip onun çekimli hallerinden biriyse çekimini kaldırıp kökenini bulma. (Drove -> drive)
WordNet
    Synset
        Synset => synonym set => eş anlamlılar kümesi
        WordNet'in iç yapısında synset dediğimiz bir yapı söz konusu.  
     Hypernym
        Hypernym => üst kavram
        is-a ilişkisine denk geliyor.
        Ağaç yapısında üste doğru cıktıkca genelleme artıyor. 
    Hyponym
        Hyponym => alt kavram , hypernym tersi.
        Bir kelime birden fazla kelimenin alt anlamı olabilir.
    Entity
        En tepedeki kavram tek bir kavram = entity(varlık)
        Altında ise physical entity ve abstract entity ayrılıyor.
    Antonym
        Antonym => Zıt anlam
    Ontoloji
        Kavramların birbiriyle olan ilişkilerini gösteren bir yapı, bir ağaç yapısı
    Lexical ontoloji 
        Lexical ontoloji => kavram-sözcük ontolojisi
    Thesaurus
        Thesaurus => Zıt anlamlılar
'''

'''
Euro Wordnet

Lema
    Tek bir kavrama denk gelen şey bir kelime
Lematizion
    Eğer köke indirgeyebileceği bir şey varsa indirgiyor(stemming yapıyor) wordneti kontrole diyor lemalar içinde varsa onu kabul ediyor
Word Embedding 
    Wordnet gibi bir ontoloji kullanıyor, bir de corpusda bir ögrenme yapıyor. 
    Kelimelerin birbirine  yakınlığı, birbiriyle geçmiş oldugunu contextler çıkıyor.
    Kelimelerin birbirlerine yakınlığını bulabiliyor.
Compositionality Principle
    birleşim ilkesi
'''
from nltk.corpus import wordnet
word = "dog"

# sarr = wordnet.synsets(word)
# print(sarr) # Dog kelimesinin synsetlerini çıkarıyor. Synset('dog.n.01') => Dog noun olan halinin 1.anlamı 
# print(sarr[0].definition()) # İlk synsetin tanımı
# print(sarr[0].hypernyms()) # birden fazla ise multiple inheritance
# print(sarr[0].pos()) # part of speech (n)
# print(sarr[0].name()) # (dog.n.01)
# print(sarr[0].hyponyms())
# print(sarr[0].hypernym_paths()) # Başka kavramla ilişkisini bulmak için pathi inceleyebiliriz.

s2 = wordnet.synsets("win")
# a = s2[2]
# print(s2)
# print(a.lemmas()) 
# print(a.lemmas()[0].antonyms()) # Zıt Anlam

synArr = []

for syn in s2:
    print(syn)
    for lem in syn.lemmas():
        print(lem.name())    
        synArr.append(lem.name())

antArr = [] 
for syn in s2:
    for lem in syn.lemmas():
        for ant in lem.antonyms():
            antArr.append(ant.name())

# print(set(synArr))
# print(set(antArr))
# print(list(dict.fromkeys(synArr)))

'''
Wu Palmer Similarity
# lcs = lowest common subsumer bunları kapsayan
# synsetlerin similaritylerini ağaçlarda uzaklık yaparak hesaplıyor
'''
# from nltk.corpus import wordnet

# sdog = wordnet.synsets("dog")
# scat = wordnet.synsets("cat")
# spup = wordnet.synsets("puppy")

# syn1 = wordnet.synset("dog.n.01")

# sd = sdog[0]
# sc = scat[0]
# sp = spup[0]

# sim1 = sd.wup_similarity(sc)
# sim2 = sd.wup_similarity(sp)
# sim3 = sc.wup_similarity(sp)

# print(sim1)
# print(sim2)
# print(sim3)

print(wordnet.morphy("drove",wordnet.VERB))