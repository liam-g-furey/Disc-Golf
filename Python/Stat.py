import os

class Stat:
    """Disc golf statistic base class"""

    def __init__(self, name):
        directory = "games/"
        self.paths = [directory + file for file in os.listdir(directory) if file != '.' and file !=".."]
        self.csv_dump = f'ScriptFiles/{name}.csv'

    def calc_stats(self):
        pass

    def write_stats(self):
        pass

if __name__ == '__main__':
    pass
