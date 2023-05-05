import requests
import json

api_key = '6aab9e78-bfa1-4b29-af9c-cb41dc7a231d'
match_id = '1-0756da2c-f188-47f3-ab4f-73e2c3aeb304'

headers = {'Authorization': f'Bearer {api_key}'}
url = f'https://open.faceit.com/data/v4/matches/{match_id}'

response = requests.get(url, headers=headers)

if response.status_code == 200:
    data = response.json()
    nicknames = []
    # for team in data['teams']:
    #     for roster in data['roster']:
    #         for player in roster['player_id']:
    #             print(player)
    print(data)
  
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
