"""Naive script to turn a list of names into a .csv-file with unique names, splitted on first name, infix and surname."""
import csv
import re

def splitted(full):
    # TODO: recursively find infixes
    
    first = ''
    infix = ''
    last = ''
    
    parts = full.split(' ')
    if len(parts) == 1:
        last = full
    elif len(parts) == 2:
        first = parts[0]
        last = parts[1]
    else:
        last = parts[-1]
        if is_infix(parts[1:-1]):
            first = parts[0]
            infix = ' '.join(parts[1:-1])
        else:
            print ' '.join(parts[1:-1])
            first = ' '.join(parts[0:-1])
    
    return [full, first, infix, last]

def is_infix(infixes):
    infix = ' '.join(infixes)
    return infix in ['van', 'de', 'den', 'van de', 'van der', 'van den', 'v.d.', 'von', 'ten', 'op de']

unique_persons = set()
with open('in.txt') as in_file:
    for line in in_file:
        line = re.sub(r'\(.*?\)', '', line)
        persons = line.split(';')
        
        for person in persons:
            p = person.strip()
            if p:
                unique_persons.add(p)
    
with open('out.csv', 'wb') as out_file:
    csv_writer = csv.writer(out_file)
    csv_writer.writerow(['name', 'first', 'infix', 'last'])
    for person in sorted(unique_persons):
        csv_writer.writerow(splitted(person))
