 
from prettytable import PrettyTable
from prettytable import from_csv


with open("coinmarketcap.csv") as fp:
    mytable = from_csv(fp)
    mytable.del_column('')
    #print(mytable)
code = mytable.get_html_string() #<< maybe edit html code here
html_file = open('priceTable.php', 'w')
html_file = html_file.write(code)