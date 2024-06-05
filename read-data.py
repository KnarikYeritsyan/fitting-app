import numpy as np
from pandas import read_csv
import pandas as pd
import sys
import json
import os

R = 8.3

datafile = sys.argv[1]
temperature = sys.argv[2]

print_data={}

if os.path.isfile(sys.argv[1]):
    file_extension = os.path.splitext(sys.argv[1])[1]
    if file_extension.lower() == ".csv":
        try:
            data = read_csv(sys.argv[1], header=None).values
        except:
            print_data['format_error'] = 'Could not process data, please check if the data file is in proper format'
            print(json.dumps(print_data))
            exit()
    else:
        try:
            data = np.loadtxt(sys.argv[1])
        except:
            print_data['format_error'] = 'Could not process data, please check if the data file is in proper format'
            print(json.dumps(print_data))
            exit()

try:
    x_exp, y_exp = data.T
except:
    print_data['error_message'] = 'Could not process data, please check if the data file is in proper format'
    print(json.dumps(print_data))
    exit()

if temperature:
    x_exp = x_exp+273.15

print_data['xexp']=pd.Series(x_exp).to_json(orient='values')
print_data['yexp']=pd.Series(y_exp).to_json(orient='values')


def show_data():
    # return print(print_data)
    return print(json.dumps(print_data))
    # return print_data

show_data()