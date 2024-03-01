import numpy as np
from sympy.abc import s,sigma,n,t,U,h,Q,q,o,p,T,H,P,O	#t_0 = o, h_ps = p
from sympy.utilities.lambdify import lambdify
from sympy import diff,sqrt,exp
from pandas import read_csv
from scipy.optimize import curve_fit
import pandas as pd
import sys
import json
import os

R = 8.3

datafile = sys.argv[1]
temperature = sys.argv[2]
unit = sys.argv[3]
repeat_units = float(sys.argv[4])
o_guess = float(sys.argv[5])
h_guess = float(sys.argv[6])
h_ps_guess = float(sys.argv[7])
Q_guess = float(sys.argv[8])

N=repeat_units

def sigma_func(Q):
    return Q**(-1)

def s_func(T,o,h,p,Q,q):
    return Q**(-1)*((exp(-(h/R)/(T-o))+(exp((p/R)/(T-o))*exp((-h/R)/(T-o))-exp((-h/R)/(T-o)))/q)**(-2)-1)

def theta_func(sigma,s):
    return ((s+sigma)/(1+s+sqrt((1-s)**2+4*sigma*s)))*(1+(2*sigma-1+s)/(sqrt((1-s)**2+4*sigma*s)))

def theta(T,o,h,p,Q,q):
    return theta_func(sigma,s).subs([(sigma,sigma_func(Q)),(s,s_func(T,o,h,p,Q,q))])

def u_1(T,o,p,q):
    return exp(p/(R*T-R*o))/(exp(p/(R*T-R*o))+q-1)

def Cp_func_water(T,o,h,p,Q,q=16):
    return -2*N*h*diff(theta(T,o,h,p,Q,q),T)-2*N*p*diff(u_1(T, o, p, q),T)*(1-theta(T, o, h, p, Q, q))+2*N*p*u_1(T, o, p, q)*diff(theta(T, o, h, p, Q, q),T)
    # return -2*h*diff(theta(T,o,h,p,Q,q),T)-2*p*diff(u_1(T, o, p, q),T)*(1-theta(T, o, h, p, Q, q))+2*p*u_1(T, o, p, q)*diff(theta(T, o, h, p, Q, q),T)

# ####################################################################

print_data={}

if os.path.isfile(sys.argv[1]):
    file_extension = os.path.splitext(sys.argv[1])[1]
    if file_extension.lower() == ".csv":
        try:
            data = read_csv(sys.argv[1], header=None).values
        except:
            print_data['error_message'] = 'Could not process data, please check if the data file is in proper format'
            print(json.dumps(print_data))
            exit()
    else:
        try:
            data = np.loadtxt(sys.argv[1])
        except:
            print_data['error_message'] = 'Could not process data, please check if the data file is in proper format'
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

if unit=='kj_mol':
    y_exp=1000*y_exp

if unit=='kcal_mol':
    y_exp=1000*4.184*y_exp

if unit=='cal_mol':
    y_exp=4.184*y_exp

# o_guess=x_exp[x_exp == min(x_exp)][0]-1
o_max=x_exp[x_exp == min(x_exp)][0]-1

xopt = np.arange(x_exp[x_exp == min(x_exp)][0]-2, x_exp[x_exp == max(x_exp)][0]+3, 0.2, dtype=np.float64)
myfunc_water = lambdify((T,o,h,p,Q),Cp_func_water(T,o*o_guess,h*h_guess,p*h_ps_guess,Q*Q_guess),'numpy')

try:
    # pars_water, pcov_water = curve_fit(myfunc_water, x_exp, y_exp, p0=[0.75, 1.0, 1.0, 1.0], bounds=[[0.1, 0.01, 0.01, 0.01], [0.99, 2.0, 2.0, 2.0]])
    pars_water, pcov_water = curve_fit(myfunc_water, x_exp, y_exp, p0=[1.0, 1.0, 1.0, 1.0], bounds=[[0.1, 0.01, 0.01, 0.01], [o_max, 2.0, 2.0, 2.0]])
    perr_water = np.sqrt(np.diag(pcov_water))
    residuals_water = y_exp-myfunc_water(x_exp, *pars_water)
    ss_res_water = np.sum(residuals_water**2)
    ss_tot_water = np.sum((y_exp-np.mean(y_exp))**2)
    r_squared_water = 1 - (ss_res_water / ss_tot_water)
    o_error=100 * perr_water[0] / abs(pars_water[0])
    h_error=100 * perr_water[1] / abs(pars_water[1])
    p_error=100 * perr_water[2] / abs(pars_water[2])
    Q_error=100 * perr_water[3] / abs(pars_water[3])
    yopt_water = myfunc_water(xopt,*pars_water)
except:
    print_data['error_message'] = 'Could not fit data, please check if the data is correct'
    print(json.dumps(print_data))
    exit()

def truncate(n, decimals=0):
    multiplier = 10 ** decimals
    return int(n * multiplier) / multiplier

try: r_squared_water
except NameError: r_squared_water = None

if r_squared_water is None:
    print_data['error_message'] = 'Could not fit data, please check if the data is correct'
else:
    print_data.update({'fit_params': {}})
    print_data.update({'fit_params_errors': {}})
    print_data['fit_params']['t0']=round(pars_water[0]*o_guess,2)
    print_data['fit_params']['h']=round(pars_water[1]*h_guess,2)
    print_data['fit_params']['h_ps']=round(pars_water[2]*h_guess,2)
    print_data['fit_params']['Q']=round(pars_water[3]*Q_guess,2)
    print_data['fit_params_errors']['t0']=round(o_error,2)
    print_data['fit_params_errors']['h']=round(h_error,2)
    print_data['fit_params_errors']['h_ps']=round(p_error,2)
    print_data['fit_params_errors']['Q']=round(Q_error,2)
    print_data['r_squared']=truncate(r_squared_water,4)
    print_data['sigma']=round(1/print_data['fit_params']['Q'],5)
    print_data['xexp']=pd.Series(x_exp).to_json(orient='values')
    print_data['yexp']=pd.Series(y_exp).to_json(orient='values')
    print_data['xopt']=pd.Series(xopt).to_json(orient='values')
    print_data['yopt']=pd.Series(yopt_water).to_json(orient='values')
    if o_error>50 or h_error>50 or p_error>50 or Q_error>50:
        print_data['warning_message'] = 'One or more parameters errors are large, please check the data again!'

def show_data():
    return print(json.dumps(print_data))

show_data()