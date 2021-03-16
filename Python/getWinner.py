import libdisc as disc

season = disc.getMostRecentSeason()
games = disc.getGamesBySeason(season)
recentGame = disc.getMostRecentGame(games)
winners = disc.getWinners(recentGame)

print(', '.join(winners))
