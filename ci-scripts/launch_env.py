#!/usr/bin/env python
import getopt
import os

import sys

from subprocess import call


def launch_machine_profile(profile, port):
    print (os.getcwd())
    call(["docker-compose", "down"])
    call(["docker-compose", "build"])
    os.environ["DEPLOY_PORT"] = str(port)
    call(["docker-compose", "-f", "docker-compose.yml", "-f", "docker-compose-" + profile + ".yml", "up", "-d"])
    del os.environ["DEPLOY_PORT"]
    pass


def main(argv):
    try:
        opts, args = getopt.getopt(argv, "p=", ["profile=", "port="])
    except getopt.GetoptError:
        sys.exit(2)

    profile = 'dev'
    port = 8081
    for opt, arg in opts:
        if opt in ["p", "--profile"]:
            profile = arg
        if opt in ["--port"]:
            port = arg
    launch_machine_profile(profile, port=port)


if __name__ == "__main__":
    main(sys.argv[1:])
