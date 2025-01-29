import syncedlyrics
import re
import json

query = input("Enter Song Name: ")
lrc = syncedlyrics.search(query)

if not lrc:
    print("No lyrics found for the given song.")
else:
    data = lrc
    print(f"Lyrics data: {data}")  # Debugging the fetched data

    lines = data.split('\n')
    json_data = []

    pattern = r'\[(\d+:\d+\.\d+)\] (.+)'

    for line in lines:
        match = re.match(pattern, line)
        if match:
            timestamp, text = match.groups()
            json_entry = {"time": timestamp, "lyrics": text}
            json_data.append(json_entry)

    print(f"Processed Data: {json_data}")  # Check the structured data

    json_string = json.dumps(json_data, indent=4)
    print(json_string)  # View the final JSON

    output_file = f"{query.replace(' ', '_')}_lyrics.json"
    try:
        with open(output_file, 'w', encoding='utf-8') as file:
            file.write(json_string)
        print(f"Lyrics saved to {output_file}")
    except Exception as e:
        print(f"Error saving file: {e}")
