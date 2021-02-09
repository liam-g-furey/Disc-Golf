import csv
import Stat
import CourseAverages

class WeightedAveragePerformance(Stat.Stat):
    """Calculates player average score (weighted by course)"""

    def __init__(self):
        super().__init__('WeightedAveragePerformance')
        self.waps = {}
        c = CourseAverages.CourseAverages()
        c.calc_stats()
        self.course_averages = c.course_averages
        self.min_course = self.course_averages[min(self.course_averages)]
    
    def calc_stats(self):
        for path in self.paths:
            with open(path, mode = 'r') as infile:
                reader = csv.reader(infile, quoting = csv.QUOTE_MINIMAL)
                next(reader)
                course_name = next(reader)[1]
                for row in reader: 
                    player_name = row[0]
                    raw_score = int(row[5])
                    adjustment = self.course_averages[course_name]/self.min_course
                    new_score = raw_score/adjustment
                    if player_name not in self.waps.keys():
                        self.waps[player_name] = [new_score]
                    else:
                        self.waps[player_name].append(new_score)

        for player_name in self.waps.keys():
            recorded_values = self.waps[player_name]
            total_score = sum(recorded_values)
            total_games = len(recorded_values)
            self.waps[player_name] = total_score/total_games

    def write_stats(self):
        with open(self.csv_dump, mode = 'w') as outfile:
            writer = csv.writer(outfile, quoting = csv.QUOTE_MINIMAL)
            order = sorted(self.waps.items(), key = lambda x: x[1])
            for key, value in order:
                writer.writerow([key, round(value,2)])


if __name__ == '__main__':
    w = WeightedAveragePerformance()
    w.calc_stats()
    w.write_stats()
