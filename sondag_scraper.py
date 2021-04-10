from bs4 import BeautifulSoup as bs
import csv
import os
import re

# could not figure out how to get beautifulsoup to get rid of a couple html characters
# so I had to use this "manual" workaround
with open("https _sondag.fi_tilaustuotteet.html", 'r') as in_file, open("siistityt_tuotteet.html", 'a') as out_file:
    for line in in_file:
        line = re.sub("&nbsp;", "", line)
        line = re.sub("<br>", "", line)
        out_file.write(line)
    in_file.close()
    out_file.close()

# get page source html make soup out of it
with open("siistityt_tuotteet.html") as f:
    soup = bs(f, "html.parser")

# find the paragraphs with product info
raw = []
products = soup.find_all("p")
for item in products:
    for t in item.children:
        raw.append(t.string)


# convert tag objects to strings and mark starting point of actual product data
data = []
start = 0
for i, line in enumerate(raw):
    data.append(str(line))
    if "cleanser for normal skin" in data[i].lower().strip():
        start = i
data = data[start:]

data.remove("TILAPÄISESTI LOPPU, LISÄÄ TULOSSA MAHDOLLISIMMAN PIAN.")

# clean up data points
for e, dp in enumerate(data):
    data[e] = dp.strip('.').strip(' ').strip('.')
    if data[e] == "None" or len(dp) < 3:
        data.remove(data[e])

# export data to a csv file
if os.path.exists("tuotteet.csv"):
    os.remove("tuotteet.csv")
with open("tuotteet.csv", 'w') as f:
    w = csv.writer(f)
    for i in range(0, len(data) - 4, 4):
        w.writerow(data[i:i+4])
f.close()

print("Success!")
exit(0)