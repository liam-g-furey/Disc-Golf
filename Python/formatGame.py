#!/usr/bin/env python3

import sys
from collections import OrderedDict
import csv

def format():

	with open(sys.argv[1],'r') as csv_file:
		csv_reader = csv.reader(csv_file)


		master_table = [row for row in csv_reader]
		table_len = len(master_table) - 1

		data_table = master_table[2:]
		headings = {key:index for index, key in enumerate(master_table[0])}

		holes = len(data_table[0]) - 6
		front_start = 6
		back_start = front_start + int(holes / 2)

		par = calculate_par(master_table[1], front_start)

		data_table.sort(key = lambda player_line: calculate_scores(player_line, front_start, back_start)[2])

		player_olist = [_[0] for _ in data_table]
		player_olist[player_olist.index('Discer')] = 'Aidan'

		scores = [calculate_scores(_, front_start, back_start)[2] for _ in data_table]
		score_dict = {p:s for p,s in zip(player_olist, scores)}


		toPar_dict = {p:s-par for p,s in zip(player_olist, scores)}

		frontback_scores = [calculate_scores(_, front_start, back_start)[0:2] for _ in data_table]
		fb_dict = {p:fb for p, fb in zip(player_olist,frontback_scores) }


		pos = calculate_placings(list(zip(player_olist, scores)))

		data = []
		for player in player_olist:
			data.append([
				pos[player],
				player,
				toPar_dict[player],
				fb_dict[player][0],
				fb_dict[player][1],
				score_dict[player]
				])

		
	with open(sys.argv[1] + "_formatted.csv", "w") as w_file:
		csvwriter = csv.writer(w_file)
		csvwriter.writerows(data)


def calculate_par(par, front_start):
	return sum(map(int, par[front_start:]))


def calculate_placings(scores):
	
	res = {} #Dicts are now sorted on insertion

	placement = 0
	lastScore = 0
	lastPlayer = ""
	for k,v in scores:
		if v == lastScore:
			res[k], res[lastPlayer] = "T" + str(placement)

		else:
			placement += 1
			lastScore = v
			res[k] = str(placement)
		lastPlayer = k
	return res


def calculate_scores(player_data, front_start, back_start):

	front = sum(map(int,player_data[front_start:back_start]))
	back = sum(map(int,player_data[back_start::]))
	
	return (front, back, front + back)






format()