import pandas as pd
import sys

csv_path = 'https://www.cryptodatadownload.com/cdd/Binance_DOGEUSDT_d.csv'

csv_path = sys.argv[1]
csv = pd.read_csv(csv_path, parse_dates=['date'],skiprows=1)

print(csv['symbol'][0])

# print(5555)