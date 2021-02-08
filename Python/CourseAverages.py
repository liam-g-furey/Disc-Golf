import csv
import Stat

class CourseAverages(Stat.Stat):
    """Calculates course average score"""

    def __init__(self):
        super().__init__('CourseAverages')
        self.course_averages = {}
    
    def calc_stats(self):
        for path in self.paths:
            with open(path, mode = 'r') as infile:
                reader = csv.reader(infile, quoting = csv.QUOTE_MINIMAL)
                next(reader)
                course_name = next(reader)[1]
                round_scores = []
                for row in reader:
                    round_scores.append(int(row[5]))
                avg_score = sum(round_scores)/len(round_scores)

                if course_name not in self.course_averages.keys():
                    self.course_averages[course_name] = [avg_score]
                else:
                    self.course_averages[course_name].append(avg_score)

        for course_name in self.course_averages.keys():
            recorded_values = self.course_averages[course_name]
            total_score = sum(recorded_values)
            total_games = len(recorded_values)
            self.course_averages[course_name] = total_score/total_games

    def write_stats(self):
        with open(self.csv_dump, mode="w") as outfile:
            writer = csv.writer(outfile, delimiter=',', quotechar='"',quoting=csv.QUOTE_MINIMAL)
            for key, value in self.course_averages.items():
                writer.writerow([key, round(value,2)])

if __name__ == '__main__':
    c = CourseAverages()
    c.calc_stats()
    c.write_stats()
