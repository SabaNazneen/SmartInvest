from flask import Flask, render_template, request
import pandas as pd
from sklearn.ensemble import RandomForestRegressor
from sklearn.cluster import KMeans
import warnings

warnings.filterwarnings("ignore", category=UserWarning)
warnings.filterwarnings("ignore", category=FutureWarning)

app = Flask(__name__)

# Load stock data
data = pd.read_csv("five_months_stock_data.csv")

df = pd.read_csv('miniproject.csv')  
k = 3
kmeans = KMeans(n_clusters=k)
kmeans.fit(df[['Income', 'Savings']])
cluster_centers = kmeans.cluster_centers_
labels = kmeans.labels_
df['cluster'] = labels

def predict_cluster(Income, Savings):
    customer_data = [[Income, Savings]]
    cluster = kmeans.predict(customer_data)
    return cluster[0]

# Get the list of unique tickers
tickers = data['ticker'].unique()

# Define the specific date
specific_date = "2024-04-24"

# Define a function to calculate potential returns
def calculate_returns(initial_price, future_price):
    return (future_price - initial_price) / initial_price * 100

# Function to categorize expected returns
def categorize_returns(return_percentage):
    if return_percentage <= 4:
        return 'Low'
    elif 4 < return_percentage <= 15:
        return 'Medium'
    else:
        return 'High'

@app.route('/')
def index():
    return render_template('example.html')

@app.route('/newpage.html')
def newpage():
    return render_template('newpage.html')

@app.route('/index.html')
def index2():
    return render_template('example.html')

@app.route('/app.py', methods=['POST'])
def predict():
    if request.method == 'POST':
        # Extracting form data
        income = float(request.form['income'])
        savings = float(request.form['savings'])
        investment_amount = float(request.form['investment_amount'])
        investment_time = int(request.form['investment_duration'])
        
        # Validate the investment time input
        if not 1 <= investment_time <= 10:
            return render_template('error.html', message="Invalid investment time horizon. Please enter a value between 1 and 10.")
        
        # Define the number of days based on the investment time horizon
        days_in_investment_time = investment_time * 30

        # Initialize lists to store suggested stocks
        low_expected_return_stocks = []
        medium_expected_return_stocks = []
        high_expected_return_stocks = []

        # Iterate over each ticker
        for ticker in tickers:
            # Filter data for the current ticker
            ticker_data = data[data['ticker'] == ticker]

            # Extract features and target variable for training
            X_stock = ticker_data[['1. open', '2. high', '3. low', '5. volume', 'sentiment_score']]
            y_stock = ticker_data['4. close']

            # Get the price for the specific date if available
            specific_date_data = ticker_data[ticker_data['date'] == specific_date]
            if not specific_date_data.empty:
                specific_date_price = specific_date_data['4. close'].values[0]
            else:
                continue  # Skip to the next ticker if data is not available for the specific date

            # Train the Random Forest Regressor for stock price prediction
            model_stock = RandomForestRegressor(n_estimators=100, random_state=42)
            model_stock.fit(X_stock, y_stock)

            # Make predictions for the specified investment time horizon
            future_X = X_stock.tail(days_in_investment_time)
            future_y_pred = model_stock.predict(future_X)

            # Calculate potential returns
            potential_return = calculate_returns(specific_date_price, future_y_pred[0])

            # Categorize expected returns
            return_category = categorize_returns(potential_return)

            # Cluster customers based on expected returns
            predicted_cluster = predict_cluster(income,savings)

            # Calculate potential returns for the current stock
            specific_date_data = data[(data['ticker'] == ticker) & (data['date'] == specific_date)]
            if not specific_date_data.empty:
                specific_date_price = specific_date_data['4. close'].values[0]
                future_y_pred = model_stock.predict(future_X)
                potential_return = calculate_returns(specific_date_price, future_y_pred[0])
                return_category = categorize_returns(potential_return)

                # Add the stock to the respective list based on the return category
                if return_category == 'Low':
                    low_expected_return_stocks.append(ticker)
                elif return_category == 'Medium':
                    medium_expected_return_stocks.append(ticker)
                else:
                    high_expected_return_stocks.append(ticker)

        # Print the suggested stocks based on the predicted cluster
        if predicted_cluster == 1:
            suggestion = "Customer is in the low expected return category. Consider the following stocks:"
            stocks = low_expected_return_stocks
        elif predicted_cluster == 2:
            suggestion = "Customer is in the medium expected return category. Consider the following stocks:"
            stocks = medium_expected_return_stocks
        else:
            suggestion = "Customer is in the high expected return category. Consider the following stocks:"
            stocks = high_expected_return_stocks

        return render_template('result.html', suggestion=suggestion, stocks=stocks)
    else:
        # In case of a GET request to /app.py, redirecting to the index page
        return redirect('/')

if __name__ == '__main__':
    app.run(debug=True)
