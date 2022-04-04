from sklearn.preprocessing import StandardScaler
from sklearn.linear_model import LinearRegression
import pandas as pd
import sys
from copy import copy
import pickle

lr = pickle.load(open('finalized_model.sav', 'rb'))
print(type(lr))

open = sys.argv[1]
high = sys.argv[2]
low = sys.argv[3]

ans = lr.predict([[open,high,low]])
# ans = lr.predict([[0.6,0.8,0.6]])
print("%.2f" %ans[0][0])
# print(sys.argv[2])