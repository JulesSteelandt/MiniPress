import 'package:flutter/material.dart';

class Loading extends StatelessWidget {
  final String titre;

  const Loading({super.key, required this.titre});

  @override
  Widget build(BuildContext context) {
    return Center(
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: <Widget>[
          Text(
            titre,
            textAlign: TextAlign.center,
            style: const TextStyle(
                color: Colors.lightGreen,
                fontSize: 40
            ),
          ),
          const SizedBox(
            height: 80,
          ),
          Transform.scale(
            scale: 4.0,
            child: const CircularProgressIndicator(
              backgroundColor: Colors.lightGreenAccent,
              color: Colors.green,
              strokeWidth: 4,
            ),
          ),
        ],
      ),
    );
  }
}