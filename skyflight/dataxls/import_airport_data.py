import pandas as pd
import mysql.connector

# ✅ Connect to MySQL
conn = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",  # set your MySQL password if any
    database="musafir_db"
)
cursor = conn.cursor()

# ✅ Load Excel files with correct paths
countries_df = pd.read_excel("D:/MyProjects/Xampp/htdocs/musafir/dataxls/countries.xlsx")
cities_df = pd.read_excel("D:/MyProjects/Xampp/htdocs/musafir/dataxls/cities.xlsx")

# ✅ Import countries
print("Importing countries...")
for country in countries_df["Country"].dropna().unique():
    cursor.execute("INSERT IGNORE INTO countries (name) VALUES (%s)", (country,))
conn.commit()

# ✅ Build country map: name → id
cursor.execute("SELECT id, name FROM countries")
country_map = {name: cid for cid, name in cursor.fetchall()}

# ✅ Import cities
print("Importing cities...")
for _, row in cities_df.iterrows():
    country_name = row["Country"]
    city = row["City"]
    code = row["Airport Code"]
    lat = row["Latitude"]
    lon = row["Longitude"]

    if country_name not in country_map:
        print(f"Skipping city {city} — country not found: {country_name}")
        continue

    country_id = country_map[country_name]
    cursor.execute("""
        INSERT INTO cities (name, country_id, airport_code, latitude, longitude)
        VALUES (%s, %s, %s, %s, %s)
    """, (city, country_id, code, lat, lon))

conn.commit()
cursor.close()
conn.close()
print("✅ Import complete.")
