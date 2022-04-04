import re
import requests
from bs4 import BeautifulSoup
import pandas as pd
import csv

r = requests.get('https://www.cryptodatadownload.com/data/binance/')
c = r.content
soup = BeautifulSoup(c)

main_content = soup.find('div', attrs = {'class': 'unit-body'})

content = main_content.find_all('p')

paragraphs = []
for x in content:
    paragraphs.append(str(x))

names = []
link_Daily = []
for i in range(len(paragraphs)):
  # เลือกเเค่ pattern นี้ ([ช่องว่าง][A-Z 0-n ตัว]/[A-Z 0-n ตัว] )
  name_pattern = re.compile(r'( [A-Z]*/[A-Z]*)', flags = re.M)
  names += name_pattern.findall(paragraphs[i])
  names 
  # เลือกเเค่ pattern นี้ (https:[ตัวอะไรก็ได้ 0-n ตัว]v )
  link_pattern = re.compile(r'(https:.*_d.csv)', flags = re.M)
  link_Daily += link_pattern.findall(paragraphs[i])
  link_Daily
#names 

data_set = pd.DataFrame({'pair of coins' : names})
data_set['csv link'] = link_Daily

print(data_set) 
## R is pandas dataframe

data_set.to_csv('cyrpto_link.csv', index=False)
