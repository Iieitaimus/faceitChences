import requests
import json

api_key = '6aab9e78-bfa1-4b29-af9c-cb41dc7a231d'
match_id = '1-87d5e9b4-306a-4917-868d-ab44b42b39cf'

headers = {'Authorization': f'Bearer {api_key}'}
url = f'https://open.faceit.com/data/v4/matches/{match_id}'

response = requests.get(url, headers=headers)

if response.status_code == 200:
    data = response.json()
    nicknames = []
    print(data)
    # for round in data['rounds']:
    #     for team in round['teams']:
    #         for player in team['players']:
    #             nicknames.append(player['nickname'])

    #print(nicknames)
  
else:
    print(f'Request failed with status code {response.status_code}')



# api_key = '6aab9e78-bfa1-4b29-af9c-cb41dc7a231d'

# headers = {'Authorization': f'Bearer {api_key}'}
# url = "https://open.faceit.com/data/v4/players/deec8468-57d1-4e94-8663-1c987516669e/stats/csgo"

# response = requests.get(url, headers=headers)

# if response.status_code == 200:
#     data = response.json()
#     maps = []
    
#     for segment in data['segments']:
#         map = segment['label']
#         print(segment['stats']['Win Rate %'])
  

#     print(maps)
# else:
#     print(f'Request failed with status code {response.status_code}')
