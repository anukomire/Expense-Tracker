CREATE TABLE expen (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    category ENUM('Food', 'Travel', 'Shopping', 'Others') NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    expense_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

/*write this code in expensetracker so that it will create a table expen and enter data down i am gving few examples how to insert data*/
/*-- Insert 100 rows of random expense data*/
INSERT INTO expen (title, category, amount, expense_date) VALUES
('Groceries', 'Food', 500.75, '2024-11-01'),
('Movie Tickets', 'Entertainment', 800.50, '2024-11-02'),
('Dinner at Restaurant', 'Food', 1200.30, '2024-11-03'),
('Train Tickets', 'Travel', 450.25, '2024-11-04'),
('Hotel Stay', 'Travel', 3500.00, '2024-11-05'),
('Clothes Shopping', 'Shopping', 1500.00, '2024-11-06'),
('Gym Membership', 'Health', 2500.50, '2024-11-07'),
('Cafe Coffee', 'Food', 180.75, '2024-11-08'),
('Flight Tickets', 'Travel', 7000.00, '2024-11-09'),
('Electricity Bill', 'Bills', 1500.20, '2024-11-10'),
('Mobile Recharge', 'Bills', 350.00, '2024-11-11'),
('Taxi Ride', 'Travel', 350.50, '2024-11-12'),
('Lawn Mower', 'Household', 1200.00, '2024-11-13'),
('Books', 'Education', 500.50, '2024-11-14'),
('Coffee Machine', 'Household', 2500.00, '2024-11-15'),
('Mobile Accessories', 'Shopping', 800.00, '2024-11-16'),
('Monthly Internet Bill', 'Bills', 700.00, '2024-11-17'),
('Dinner Party', 'Food', 2500.75, '2024-11-18'),
('House Cleaning', 'Household', 1500.00, '2024-11-19'),
('Online Course', 'Education', 1500.00, '2024-11-20'),
('Uber Ride', 'Travel', 400.25, '2024-11-21'),
('Vacation Booking', 'Travel', 25000.00, '2024-11-22'),
('Laptop Repair', 'Electronics', 3500.50, '2024-11-23'),
('Lunch at Office', 'Food', 300.00, '2024-11-24'),
('Netflix Subscription', 'Entertainment', 499.00, '2024-11-25'),
('Gaming Console', 'Electronics', 22000.00, '2024-11-26'),
('Groceries Delivery', 'Food', 850.50, '2024-11-27'),
('Air Conditioning Service', 'Household', 3500.00, '2024-11-28'),
('Movie Streaming', 'Entertainment', 350.00, '2024-11-29'),
('Bicycle', 'Transport', 5000.00, '2024-11-30'),
('Health Insurance', 'Health', 12000.00, '2024-12-01'),
('Wi-Fi Router', 'Electronics', 4500.00, '2024-12-02'),
('Electric Car Charging', 'Transport', 1200.00, '2024-12-03'),
('Birthday Party', 'Entertainment', 5000.00, '2024-12-04'),
('Car Fuel', 'Transport', 2000.00, '2024-12-05'),
('Food Delivery', 'Food', 800.00, '2024-12-06'),
('Smartphone', 'Electronics', 25000.00, '2024-12-07'),
('Party Decorations', 'Entertainment', 1500.00, '2024-12-08'),
('Online Shopping', 'Shopping', 4500.00, '2024-12-09'),
('New Shoes', 'Shopping', 3500.00, '2024-12-10'),
('Fashion Accessories', 'Shopping', 1200.00, '2024-12-11'),
('Pet Care', 'Health', 3000.00, '2024-12-12'),
('Subscription Service', 'Entertainment', 1000.00, '2024-12-13'),
('Car Insurance', 'Transport', 8000.00, '2024-12-14'),
('Home Decor', 'Household', 4000.00, '2024-12-15'),
('Books Subscription', 'Education', 800.00, '2024-12-16'),
('Swimming Pool Maintenance', 'Household', 2500.00, '2024-12-17'),
('Electric Bill', 'Bills', 1200.00, '2024-12-18'),
('Magazine Subscription', 'Entertainment', 150.00, '2024-12-19'),
('Vegetables', 'Food', 300.00, '2024-12-20'),
('New Phone Case', 'Shopping', 1000.00, '2024-12-21'),
('Candle', 'Household', 150.00, '2024-12-22'),
('Music Concert', 'Entertainment', 2000.00, '2024-12-23'),
('Grocery Shopping', 'Food', 1500.00, '2024-12-24'),
('Swimming Lessons', 'Health', 2500.00, '2024-12-25'),
('Cabs for Family', 'Travel', 3000.00, '2024-12-26'),
('Travel Insurance', 'Travel', 3000.00, '2024-12-27'),
('Outdoor Sports Equipment', 'Sports', 5000.00, '2024-12-28'),
('Toys', 'Shopping', 1000.00, '2024-12-29'),
('Gifts for Family', 'Shopping', 2000.00, '2024-12-30'),
('Electric Appliance', 'Household', 4000.00, '2024-12-31'),
('New Couch', 'Household', 8000.00, '2024-12-31'),
('Laptop Accessories', 'Electronics', 2000.00, '2024-12-01'),
('New Year Party', 'Entertainment', 15000.00, '2024-12-01'),
('Spa and Massage', 'Health', 2500.00, '2024-12-02'),
('Gourmet Dinner', 'Food', 5000.00, '2024-12-03'),
('Photography Equipment', 'Electronics', 3500.00, '2024-12-04'),
('Tickets for Event', 'Entertainment', 2500.00, '2024-12-05'),
('Party Supplies', 'Shopping', 1500.00, '2024-12-06'),
('Beach Vacation', 'Travel', 10000.00, '2024-12-07'),
('Gym Equipment', 'Health', 3000.00, '2024-12-08'),
('Designer Clothes', 'Shopping', 12000.00, '2024-12-09'),
('Coffee Shop', 'Food', 1500.00, '2024-12-10'),
('Sushi Dinner', 'Food', 1800.00, '2024-12-11'),
('Weekend Getaway', 'Travel', 7000.00, '2024-12-12'),
('Subscription for Web Hosting', 'Education', 2500.00, '2024-12-13'),
('Dental Treatment', 'Health', 5000.00, '2024-12-14'),
('Laptop', 'Electronics', 35000.00, '2024-12-15'),
('Camping Equipment', 'Sports', 15000.00, '2024-12-16'),
('Kitchen Appliances', 'Household', 8000.00, '2024-12-17'),
('Weekly Groceries', 'Food', 1500.00, '2024-12-18'),
('Private Yoga Class', 'Health', 4000.00, '2024-12-19'),
('Birthday Gifts', 'Shopping', 7000.00, '2024-12-20'),
('Car Service', 'Transport', 3000.00, '2024-12-21'),
('Personal Trainer', 'Health', 5000.00, '2024-12-22'),
('Gadget Repairs', 'Electronics', 2000.00, '2024-12-23'),
('Painting Materials', 'Entertainment', 3000.00, '2024-12-24'),
('Luxury Watch', 'Shopping', 10000.00, '2024-12-25'),
('Family Vacation', 'Travel', 25000.00, '2024-12-26'),
('Antique Furniture', 'Household', 12000.00, '2024-12-27'),
('New TV', 'Electronics', 25000.00, '2024-12-28'),
('Tickets for Museum', 'Entertainment', 1500.00, '2024-12-29'),
('Skiing Equipment', 'Sports', 5000.00, '2024-12-30'),
('Party Drinks', 'Entertainment', 2500.00, '2024-12-31');
