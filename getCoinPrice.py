import re
import requests
from bs4 import BeautifulSoup
import pandas as pd

link='https://coinmarketcap.com/'
r = requests.get(link)
c = r.content
soup = BeautifulSoup(c)
main_content = soup.find('div', attrs = {'class': 'h7vnx2-1 bFzXgL'})

paragraphs = []
for x in main_content:
    paragraphs.append(str(x))
    
focus_point = ''
name_pattern = re.compile(r'(<tbody>.*)', flags = re.M)
focus_point = name_pattern.findall(paragraphs[0])
focus_point

tr = []
# เลือกเเค่ pattern นี้ ([A-Z 0-n ตัว]/[A-Z 0-n ตัว] )
tr_pattern = re.compile(r'<tr>.+?</tr>', flags = re.M)
tr += tr_pattern.findall(focus_point[0])


td = []
# เลือกเเค่ pattern นี้ ([A-Z 0-n ตัว]/[A-Z 0-n ตัว] )
for i in tr:
  temp = []
  td_pattern = re.compile(r'<td.+?>.+?</td>', flags = re.M)
  temp += td_pattern.findall(i)
  td.append(temp)

output_table = pd.DataFrame()

price = []
for i in td:
  pattern = re.compile(r'<span>.+?</', flags = re.M)
  price += pattern.findall(i[3])
for i in range(len(price)):
  price[i] = price[i][6:-2]

#day_percent = []
#for i in td:
#  pattern = re.compile(r'</span>.+?<!', flags = re.M)
#  day_percent += pattern.findall(i[4])
#for i in range(len(day_percent)):
#  day_percent[i] = day_percent[i][7:-2]


#_7_day_percent = []
#for i in td:
#  pattern = re.compile(r'</span>.+?<!', flags = re.M)
#  _7_day_percent += pattern.findall(i[5])
#for i in range(len(_7_day_percent)):
#  _7_day_percent[i] = _7_day_percent[i][7:-2]

#marketcap = []
#for i in td:
#  pattern = re.compile(r'data-nosnippet="true">.+?</span>', flags = re.M)
#  marketcap += pattern.findall(i[6])
#for i in range(len(marketcap)):
#  marketcap[i] = marketcap[i][22:-7]

#vol_usd = []
#for i in td:
#  pattern = re.compile(r'font-size="1">.+?</p>', flags = re.M)
#  vol_usd  += pattern.findall(i[7])
#for i in range(len(vol_usd)):
#  vol_usd[i] = vol_usd[i][14:-4]
  
#vol_coin = []
#for i in td:
#  pattern = re.compile(r'font-size="0">.+?</p>', flags = re.M)
#  vol_coin  += pattern.findall(i[7])
#for i in range(len(vol_coin)):
#  vol_coin[i] = vol_coin[i][14:-4]
  
#graph = []
#for i in td:
#  pattern = re.compile(r'src=".+?"', flags = re.M)
#  graph  += pattern.findall(i[9])
#for i in range(len(graph)):
#  graph[i] = graph[i][5:-1]
  
name = []
for i in td:
  pattern = re.compile(r'font-size="0">.+?</p>', flags = re.M)
  name  += pattern.findall(i[7])
for i in range(len(name)):
  name[i] = name[i].split(' ')[1]
  name[i] = name[i].split('<')[0]
  
output_table['Coin'] = name
output_table['Price'] = price
#output_table['day_percent'] = day_percent
#output_table['7day_percent'] = _7_day_percent
#output_table['marketcap'] = marketcap
#output_table['vol_usd'] = vol_usd
#output_table['vol_coin'] = vol_coin
#output_table['graph'] = graph 


output_table.to_csv('coinmarketcap.csv')