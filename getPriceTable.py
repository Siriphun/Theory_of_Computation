 
from prettytable import PrettyTable
from prettytable import from_csv


with open("coinmarketcap.csv") as fp:
    mytable = from_csv(fp)
    mytable.del_column('')
    #print(mytable)
code = mytable.get_html_string() #<< maybe edit html code here
code = code.replace('<td>$','<td style="color: #08d169;padding-left: 20px">$').replace('<table>','<table style ="background-color: #283134;color:white;">')
#print(code)
html_file = open('priceTable.php', 'w')
html_file = html_file.write(code)

