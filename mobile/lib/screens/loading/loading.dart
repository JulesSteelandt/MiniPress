import 'package:flutter/material.dart';
import 'package:mobile/utils/app_utils.dart';

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
                color: AppUtils.primaryBackground,
                fontSize: 40
            ),
          ),
          const SizedBox(
            height: 80,
          ),
          Transform.scale(
            scale: 4.0,
            child: const CircularProgressIndicator(
              backgroundColor: AppUtils.primaryBackground,
              color: AppUtils.secondaryBackground,
              strokeWidth: 4,
            ),
          ),
        ],
      ),
    );
  }
}