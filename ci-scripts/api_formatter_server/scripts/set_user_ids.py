#!/usr/bin/env python

from shutil import move
from tempfile import mkstemp

from os import close, remove, stat


def replace(file_path, pattern, subst):
    # Create temp file
    fh, abs_path = mkstemp()
    with open(abs_path, 'w') as new_file:
        with open(file_path) as old_file:
            for line in old_file:
                if pattern in line:
                    line = subst
                new_file.write(line)
    close(fh)
    # Remove original file
    remove(file_path)
    # Move new file
    move(abs_path, file_path)


def find_owner(filename):
    uid = stat(filename).st_uid
    gid = stat(filename).st_gid
    return uid, gid


def main():
    uid, gid = find_owner("/var/www/current/README.md")
    string_to_put = "www-data:x:" + str(uid) + ":" + str(gid) + ":www-data:/var/www:/usr/sbin/nologin\n"
    replace("/etc/passwd", "www-data", string_to_put)
    string_to_put = "www-data:x:" + str(gid) + ":\n"
    replace("/etc/group", "www-data", string_to_put)


if __name__ == "__main__":
    main()
