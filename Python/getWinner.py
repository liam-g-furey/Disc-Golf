import sys, csv

with open(sys.argv[1]) as f:
	winner = ('', 1000)
	reader = csv.DictReader(f)
	holes = [x for x in next(reader).keys() if 'Hole' in x]
	for player in reader:
		score = sum([int(x[1]) for x in player.items() if x[0] in holes])
		if score < winner[1]:
			winner = (player['PlayerName'], score)
		elif score == winner[1]:
			winner = (winner[0] + ' & ' + player['PlayerName'], score)

print(winner[0])