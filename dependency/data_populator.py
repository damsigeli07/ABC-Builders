import random
from datetime import datetime, timedelta

def random_timestamp(start_year=2023, end_year=2024):
    start_date = datetime(start_year, 1, 1)
    end_date = datetime(end_year, 12, 31, 23, 59, 59)

    time_between_dates = end_date - start_date
    seconds_between_dates = time_between_dates.total_seconds()

    random_seconds = random.randint(0, int(seconds_between_dates))

    random_date = start_date + timedelta(seconds=random_seconds)
    
    return random_date.strftime('%Y-%m-%d %H:%M:%S')

def random_set(dataset) :
    random_entry = random.choice(dataset)
    return random_entry

def random_num(start, end) :
    random_number = random.randint(start, end)
    return random_number

dataset = [
    [14, "Person 1", "Address 1", "0710000000", "p1@gmail.com"],
    [15, "Person 2", "Address 2", "0720000000", "p2@gmail.com"],
    [16, "Person 3", "Address 3", "0730000000", "p3@gmail.com"],
    [17, "Person 4", "Address 4", "0740000000", "p4@gmail.com"],
]

file = open('populated.txt', 'a')

file.write("INSERT INTO `orders` (`customer_id`, `customer_name`, `material_id`, `phone`, `email`, `address`, `quantity`, `time`) VALUES ")

for i in range(100) :
    random_user = random_set(dataset)
    user_id = random_user[0]
    name = random_user[1]
    address = random_user[2]
    phone = random_user[3]
    email = random_user[4]
    mat_id = random_num(2, 16)
    quantity = random_num(1, 100)
    rand_time = random_timestamp()
    file.write(f"({user_id}, '{name}', {mat_id}, '{phone}', '{email}', '{address}', {quantity}, '{rand_time}'),\n")
    
file.close()
print("Done!")