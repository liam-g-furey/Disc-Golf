import sys
def last_winner():
	file = sys.argv[1]
	winner = {}
	f = open(file, 'r')
	next(f)
	for line in f: 
		categories = line.split(',')
		if categories[0] != 'Par':
			winner[categories[0]] = categories[4]
	mini = 1000
	winner_person = ""
	#print (winner)
	for (x,y) in winner.items():
		if int(y) < mini:
			mini = int(y)
			winner_person = x
	print (winner_person)
last_winner()