import csv
import Stat

class PlayerAverages(Stat.Stat):
    """Calculates player average score"""

    def __init__(self):
        super().__init__('PlayerAverages')
        self.player_averages = {}
    
    def calc_stats(self):
        for path in self.paths:
            with open(path, mode = 'r') as infile:
                reader = csv.reader(infile, quoting = csv.QUOTE_MINIMAL)
                next(reader)
                next(reader)
                for row in reader: 
                    player_name = row[0]
                    new_score = int(row[5])
                    if player_name not in self.player_averages.keys():
                        self.player_averages[player_name] = [new_score]
                    else:
                        self.player_averages[player_name].append(new_score)

        for player_name in self.player_averages.keys():
            recorded_values = self.player_averages[player_name]
            total_score = sum(recorded_values)
            total_games = len(recorded_values)
            self.player_averages[player_name] = total_score/total_games

    def write_stats(self):
        with open(self.csv_dump, mode = 'w') as outfile:
            writer = csv.writer(outfile, quoting = csv.QUOTE_MINIMAL)
            for key, value in self.player_averages.items():
                writer.writerow([key, round(value,2)])


if __name__ == '__main__':
    p = PlayerAverages()
    p.calc_stats()
    p.write_stats()
